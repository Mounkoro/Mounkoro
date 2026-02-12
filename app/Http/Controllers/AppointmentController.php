<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        $engineer = Auth::user()->engineerProfile;
        $appointments = $engineer->appointments()->with('serviceRequest.client.user')->orderBy('appointment_date')->get();
        $pendingRequests = ServiceRequest::where('status', 'en_attente')->with('client.user')->get();

        return view('engineer.appointments', compact('appointments', 'pendingRequests'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_request_id' => 'required|exists:service_requests,id',
            'appointment_date' => 'required|date|after:now',
        ]);

        $engineer = Auth::user()->engineerProfile;

        Appointment::create([
            'service_request_id' => $request->service_request_id,
            'engineer_id' => $engineer->id,
            'appointment_date' => $request->appointment_date,
        ]);

        // Update request status
        ServiceRequest::find($request->service_request_id)->update(['status' => 'accepte']);

        return back()->with('success', 'Rendez-vous planifié avec succès.');
    }
}
