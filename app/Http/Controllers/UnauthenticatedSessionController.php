<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class UnauthenticatedSessionController extends Controller
{
    public function newFeedback()
    {
        return view('user.others.feedback');
    }

    public function feedbackReceived(Request $request)
    {
        $query = Feedback::query()->orderBy('created_at', 'desc');

        // Filter berdasarkan type
        if ($request->filled('type') && $request->type !== 'all') {
            $query->where('type', $request->type);
        }

        // Filter berdasarkan pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('feedback_id', 'like', "%{$search}%")
                    ->orWhere('message', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan tanggal
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $feedbacks = $query->paginate(10)->withQueryString();

        // Statistics
        $stats = [
            'total' => Feedback::count(),
            'today' => Feedback::whereDate('created_at', today())->count(),
            'this_month' => Feedback::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count(),
            'by_type' => [
                'general' => Feedback::where('type', 'general')->count(),
                'bug' => Feedback::where('type', 'bug')->count(),
                'feature' => Feedback::where('type', 'feature')->count(),
            ]
        ];

        return view('admin.others.feedback-received', compact('feedbacks', 'stats'));
    }

    public function show(Feedback $feedback)
    {
        return view('admin.others.feedback-show', compact('feedback'));
    }

    public function destroy(Feedback $feedback)
    {
        $feedback->delete();

        return redirect()->route('admin.others.feedback-received')
            ->with('success', 'Feedback deleted successfully.');
    }
}
