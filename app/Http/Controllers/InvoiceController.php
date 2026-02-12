<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\ClientProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function create()
    {
        $clients = ClientProfile::with('user')->get();
        return view('engineer.invoices.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:client_profiles,id',
            'amount' => 'required|numeric|min:0',
            'items' => 'required|array',
            'items.*.description' => 'required|string',
            'items.*.price' => 'required|numeric',
            'items.*.quantity' => 'required|integer',
        ]);

        Invoice::create([
            'engineer_id' => Auth::user()->engineerProfile->id,
            'client_id' => $request->client_id,
            'amount' => $request->amount,
            'items' => $request->items,
        ]);

        return redirect()->route('engineer.dashboard')->with('success', 'Facture créée avec succès.');
    }
}
