<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Shipment;
use App\Models\Container;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class BillController extends Controller
{
    public function createBill()
    {
        return view('user.bills.bills');
    }

    public function listBill(Request $request) // Tambahkan parameter Request
    {
        $query = Bill::with(['user', 'shipment'])
            ->where('user_id', Auth::id());

        // Filtering logic
        if ($request->has('filter')) {
            $filter = $request->input('filter');
            if ($filter !== 'all') {
                $query->where('status', ucfirst($filter)); // Capitalize first letter for matching DB value
            }
        }

        $bills = $query->latest()->paginate(10);

        // Append query parameters to pagination links
        $bills->appends($request->query());

        return view('user.bills.list-bill', compact('bills'));
    }

    public function adminListBill(Request $request)
    {
        // Middleware 'admin' sudah memastikan hanya admin yang bisa akses
        $query = Bill::with(['user', 'shipment', 'container']);

        // Filtering berdasarkan status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filtering berdasarkan payment confirmation status
        if ($request->has('payment_status')) {
            if ($request->payment_status === 'with_confirmation') {
                $query->whereNotNull('upload_confirmation');
            } elseif ($request->payment_status === 'without_confirmation') {
                $query->whereNull('upload_confirmation');
            }
        }

        // Search berdasarkan bill_id atau company name
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('bill_id', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('company_name', 'like', "%{$search}%");
                  });
            });
        }

        $bills = $query->latest()->paginate(12);
        $bills->appends($request->query());

        // Debug info
        Log::info('Admin Bills List accessed', [
            'bills_count' => $bills->items() ? count($bills->items()) : 0,
            'total_bills' => $bills->total(),
            'admin_id' => Auth::id()
        ]);

        return view('admin.bills.list-bill-admin', compact('bills'));
    }

    public function markAsPaid(Bill $bill)
    {
        // Middleware 'admin' sudah memastikan hanya admin yang bisa akses
        try {
            $bill->update([
                'status' => 'Paid'
            ]);

            Log::info('Bill marked as paid by admin', [
                'bill_id' => $bill->bill_id,
                'admin_id' => Auth::id(),
                'payment_confirmed_at' => $bill->payment_confirmed_at,
                'paid_at' => $bill->paid_at
            ]);

            return redirect()->back()->with('success', "Bill {$bill->bill_id} has been marked as paid successfully.");

        } catch (\Exception $e) {
            Log::error('Failed to mark bill as paid', [
                'bill_id' => $bill->bill_id,
                'admin_id' => Auth::id(),
                'error' => $e->getMessage()
            ]);

            return redirect()->back()->with('error', 'Failed to mark bill as paid. Please try again.');
        }
    }

    public function markAsUnpaid(Bill $bill)
    {
        // Middleware 'admin' sudah memastikan hanya admin yang bisa akses

        try {
            // Hapus file konfirmasi jika ada
            if ($bill->upload_confirmation && Storage::disk('public')->exists($bill->upload_confirmation)) {
                Storage::disk('public')->delete($bill->upload_confirmation);
            }

            // Reset semua data payment confirmation dan ubah status ke Unpaid
            $bill->update([
                'status' => 'Unpaid',
                'payment_confirmed_at' => null,
                'upload_confirmation' => null,
                'paid_at' => null
            ]);

            Log::info('Bill marked as unpaid by admin, payment data cleared', [
                'bill_id' => $bill->bill_id,
                'admin_id' => Auth::id()
            ]);

            return redirect()->back()->with('success', "Bill {$bill->bill_id} has been marked as unpaid. Customer must resubmit payment confirmation.");

        } catch (\Exception $e) {
            Log::error('Failed to mark bill as unpaid', [
                'bill_id' => $bill->bill_id,
                'admin_id' => Auth::id(),
                'error' => $e->getMessage()
            ]);

            return redirect()->back()->with('error', 'Failed to mark bill as unpaid. Please try again.');
        }
    }

    public function detailBill(Bill $bill)
    {
        $bill->load(['user', 'shipment', 'container']);

        $weightRate = ceil($bill->container->weight / 100) * 90000;

        $containerTotalRate = $bill->container->rate_per_container * $bill->container->quantity;

        $totalPrice = $bill->shipment->rate + $containerTotalRate + $weightRate + 250000;

        return view('user.bills.bill-detail', compact('bill', 'weightRate', 'containerTotalRate', 'totalPrice'));
    }

    public function showPaymentConfirmation(Bill $bill)
    {
        // Pastikan bill milik user yang login
        if ($bill->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this bill.');
        }

        // Pastikan bill belum dikonfirmasi atau masih unpaid
        if ($bill->status === 'Paid') {
            return redirect()->route('detail-bill', $bill)
                ->with('error', 'Payment has already been confirmed for this bill.');
        }

        return view('user.bills.payment-confirmation', compact('bill'));
    }

    public function confirmPayment(Request $request, Bill $bill)
    {
        // Pastikan bill milik user yang login
        if ($bill->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this bill.');
        }

        // Pastikan bill belum dikonfirmasi
        if ($bill->status === 'Paid') {
            return redirect()->route('detail-bill', $bill)
                ->with('error', 'Payment has already been confirmed for this bill.');
        }

        // Validasi input
        $request->validate([
            'upload_confirmation' => 'required|file|mimes:jpeg,png,jpg,pdf|max:5120', // Max 5MB
            'paid_at' => 'required|date|before_or_equal:today',
        ], [
            'upload_confirmation.required' => 'Please upload payment confirmation file.',
            'upload_confirmation.file' => 'Payment confirmation must be a file.',
            'upload_confirmation.mimes' => 'Payment confirmation must be a JPEG, PNG, JPG, or PDF file.',
            'upload_confirmation.max' => 'Payment confirmation file size must not exceed 5MB.',
            'paid_at.required' => 'Payment date is required.',
            'paid_at.date' => 'Payment date must be a valid date.',
            'paid_at.before_or_equal' => 'Payment date cannot be in the future.',
        ]);

        try {
            // Handle file upload
            if ($request->hasFile('upload_confirmation')) {
                $file = $request->file('upload_confirmation');
                $fileName = time() . '_' . Auth::id() . '_' . $bill->bill_id . '.' . $file->getClientOriginalExtension();
                
                // Store file in storage/app/public/payment-confirmations
                $filePath = $file->storeAs('payment-confirmations', $fileName, 'public');

                // Update bill dengan konfirmasi pembayaran
                $bill->update([
                    'payment_confirmed_at' => now(),
                    'upload_confirmation' => $filePath,
                    'paid_at' => $request->paid_at,
                    'status' => 'Under Verification', // Status berubah menjadi under verification
                ]);

                Log::info('Payment confirmation submitted', [
                    'bill_id' => $bill->bill_id,
                    'user_id' => Auth::id(),
                    'file_path' => $filePath,
                    'paid_at' => $request->paid_at
                ]);

                return redirect()->route('detail-bill', $bill)
                    ->with('success', 'Payment confirmation has been submitted successfully. Your payment is now under verification.');
            }

            return back()->with('error', 'Failed to upload payment confirmation file.');

        } catch (\Exception $e) {
            Log::error('Payment confirmation failed', [
                'bill_id' => $bill->bill_id,
                'user_id' => Auth::id(),
                'error' => $e->getMessage()
            ]);

            return back()->with('error', 'An error occurred while processing your payment confirmation. Please try again.');
        }
    }

    public function cancelPaymentConfirmation(Bill $bill)
    {
        // Pastikan bill milik user yang login
        if ($bill->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this bill.');
        }

        // Hanya bisa cancel jika status Under Verification
        if ($bill->status !== 'Under Verification') {
            return redirect()->route('detail-bill', $bill)
                ->with('error', 'Cannot cancel payment confirmation for this bill.');
        }

        try {
            // Hapus file konfirmasi jika ada
            if ($bill->upload_confirmation && Storage::disk('public')->exists($bill->upload_confirmation)) {
                Storage::disk('public')->delete($bill->upload_confirmation);
            }

            // Reset kolom konfirmasi pembayaran
            $bill->update([
                'payment_confirmed_at' => null,
                'upload_confirmation' => null,
                'paid_at' => null,
                'status' => 'Unpaid',
            ]);

            Log::info('Payment confirmation cancelled', [
                'bill_id' => $bill->bill_id,
                'user_id' => Auth::id()
            ]);

            return redirect()->route('detail-bill', $bill)
                ->with('success', 'Payment confirmation has been cancelled successfully.');

        } catch (\Exception $e) {
            Log::error('Cancel payment confirmation failed', [
                'bill_id' => $bill->bill_id,
                'user_id' => Auth::id(),
                'error' => $e->getMessage()
            ]);

            return back()->with('error', 'An error occurred while cancelling payment confirmation. Please try again.');
        }
    }
}
