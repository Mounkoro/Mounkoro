<?php

namespace App\Http\Controllers;

use App\Models\EngineerProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EngineerProfileController extends Controller
{
    public function index(Request $request)
    {
        $query = EngineerProfile::with('user');

        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            })->orWhere('skills', 'like', "%$search%")
              ->orWhere('intervention_zone', 'like', "%$search%");
        }

        $engineers = $query->get();
        return view('client.engineers', compact('engineers'));
    }

    public function dashboard()
    {
        $user = Auth::user();
        $engineer = $user->engineerProfile;

        if (!$engineer) {
            $engineer = \App\Models\EngineerProfile::create(['user_id' => $user->id]);
        }

        $appointments = $engineer->appointments()->with('serviceRequest.client.user')->where('appointment_date', '>=', now())->orderBy('appointment_date')->take(5)->get();

        return view('engineer.dashboard', compact('appointments'));
    }

    public function edit()
    {
        $user = Auth::user();
        $engineer = $user->engineerProfile;

        if (!$engineer) {
            $engineer = \App\Models\EngineerProfile::create(['user_id' => $user->id]);
        }

        return view('engineer.profile', compact('engineer'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $engineer = $user->engineerProfile;

        if (!$engineer) {
            $engineer = \App\Models\EngineerProfile::create(['user_id' => $user->id]);
        }

        $request->validate([
            'skills' => 'nullable|string',
            'intervention_zone' => 'nullable|string',
            'bio' => 'nullable|string',
            'availability' => 'required|in:disponible,occupe,en_vacances',
        ]);

        $engineer->update($request->all());

        return back()->with('success', 'Profil mis à jour avec succès.');
    }
}
