<?php

namespace App\Http\Controllers;

use App\Models\Consignee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ConsigneeController extends Controller
{
    public function index()
    {
        $consignees = Consignee::where('user_id', Auth::id())->paginate(10);
        return view('user.consignees.consignee', compact('consignees'));
    }

    public function edit(string $id)
    {
        $consignee = Consignee::findOrFail($id);

        return view('user.consignees.edit-consignee', compact('consignee'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'industry' => 'required|string|max:255',
            'name_consignee' => 'required|string|max:255',
            'email' => 'required|email|unique:consignees,consignee_email,' . $id,
            'city' => 'required|string|max:255',
            'phone_number' => 'required|numeric',
            'consignee_address' => 'required|string',
        ]);

        $consignee = Consignee::findOrFail($id);

        $consignee->update([
            'industry' => $validated['industry'],
            'city' => $validated['city'],
            'consignee_name' => $validated['name_consignee'],
            'consignee_email' => $validated['email'],
            'consignee_phone' => $validated['phone_number'],
            'consignee_address' => $validated['consignee_address'],
        ]);

        return redirect()->route('consignee')
            ->with('success', 'Data consignee berhasil diperbarui');
    }


    public function destroy(string $id)
    {
        $consignee = Consignee::findOrFail($id);

        if ($consignee->consignee_id) {
            Storage::disk('public')->deleteDirectory('consignee/' . $consignee->consignee_id);
        }

        $consignee->delete();

        return redirect()->route('consignee')
            ->with('success', 'Data consignee berhasil dihapus');
    }

    public function createConsignee()
    {
        return view('user.consignees.create-consignee');
    }
}
