@extends('layouts.app')
@section('title', 'Rendez-vous')
@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-12">
    <div>
        <h3 class="text-2xl font-bold mb-8">Demandes en attente</h3>
        <div class="space-y-6">
            @forelse($pendingRequests as $request)
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm border-l-4 border-yellow-400">
                    <div class="flex justify-between items-start mb-4">
                        <span class="bg-gray-100 text-gray-600 text-[10px] font-black uppercase px-2 py-1 rounded-full">{{ $request->type }}</span>
                        <p class="text-xs text-gray-400">{{ $request->created_at->diffForHumans() }}</p>
                    </div>
                    <p class="font-bold">{{ $request->client->user->name }}</p>
                    <p class="text-sm text-gray-500 mt-1 mb-6 italic">"{{ $request->description }}"</p>

                    <form method="POST" action="{{ route('engineer.appointments.store') }}" class="flex gap-2">
                        @csrf
                        <input type="hidden" name="service_request_id" value="{{ $request->id }}">
                        <input type="datetime-local" name="appointment_date" class="flex-1 px-4 py-2 rounded-xl border border-gray-200 text-sm outline-none focus:border-primary" required>
                        <button type="submit" class="bg-primary text-white px-6 py-2 rounded-xl text-sm font-bold">Accepter</button>
                    </form>
                </div>
            @empty
                <p class="text-gray-400 italic">Aucune nouvelle demande en attente.</p>
            @endforelse
        </div>
    </div>

    <div>
        <h3 class="text-2xl font-bold mb-8">Votre Agenda</h3>
        <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-xl divide-y">
            @forelse($appointments as $appointment)
                <div class="py-6 flex items-start gap-4">
                    <div class="bg-blue-50 text-primary px-3 py-2 rounded-xl font-bold text-center">
                        <p class="text-xs">{{ $appointment->appointment_date->format('d') }}</p>
                        <p class="text-lg">{{ $appointment->appointment_date->format('M') }}</p>
                    </div>
                    <div>
                        <p class="font-bold">{{ $appointment->serviceRequest->client->user->name }}</p>
                        <p class="text-sm text-gray-500">{{ $appointment->appointment_date->format('H:i') }} - {{ $appointment->serviceRequest->location }}</p>
                        <p class="text-xs text-primary mt-1 font-medium capitalize">{{ $appointment->serviceRequest->type }}</p>
                    </div>
                </div>
            @empty
                <p class="text-gray-400 text-center py-10">Agenda vide.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
