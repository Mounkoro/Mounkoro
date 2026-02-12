<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientProfileController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $client = $user->clientProfile;

        if (!$client) {
            $client = \App\Models\ClientProfile::create(['user_id' => $user->id]);
        }

        $requests = $client->requests()->latest()->take(5)->get();
        $invoices = $client->invoices()->latest()->take(5)->get();

        return view('client.dashboard', compact('requests', 'invoices'));
    }
}
