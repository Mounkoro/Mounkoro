<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceRequestController extends Controller
{
    public function create()
    {
        return view('client.requests.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:devis,urgence,installation',
            'description' => 'required|string',
            'location' => 'nullable|string',
        ]);

        ServiceRequest::create([
            'client_id' => Auth::user()->clientProfile->id,
            'type' => $request->type,
            'description' => $request->description,
            'location' => $request->location,
        ]);

        return redirect()->route('client.dashboard')->with('success', 'Votre demande a été envoyée avec succès.');
    }
}
