@extends('layouts.app')
@section('title', 'Espace Expert')
@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    <div class="md:col-span-2 space-y-8">
        <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm">
            <h3 class="text-xl font-bold mb-6">Prochains Rendez-vous</h3>
            <div class="divide-y divide-gray-50">
                @forelse($appointments as $appointment)
                    <div class="py-4 flex items-center gap-6">
                        <div class="bg-primary text-white p-3 rounded-xl text-center min-w-[70px]">
                            <p class="text-[10px] font-black uppercase">{{ $appointment->appointment_date->format('M') }}</p>
                            <p class="text-2xl font-bold">{{ $appointment->appointment_date->format('d') }}</p>
                        </div>
                        <div class="flex-1">
                            <p class="font-bold">{{ $appointment->serviceRequest->client->user->name }}</p>
                            <p class="text-xs text-gray-500">{{ $appointment->appointment_date->format('H:i') }} - {{ $appointment->serviceRequest->type }}</p>
                        </div>
                        <span class="text-xs font-bold px-3 py-1 bg-blue-50 text-blue-700 rounded-full">{{ $appointment->status }}</span>
                    </div>
                @empty
                    <p class="text-gray-400 text-center py-4 italic">Aucun rendez-vous prévu.</p>
                @endforelse
            </div>
            <a href="{{ route('engineer.appointments') }}" class="block text-center text-primary font-bold text-sm mt-8 border border-primary/20 py-3 rounded-xl hover:bg-primary/5 transition-all">Gérer tout le calendrier</a>
        </div>
    </div>

    <div class="space-y-8">
        <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm">
            <h4 class="font-bold mb-6">Actions rapides</h4>
            <div class="space-y-4">
                <a href="{{ route('engineer.invoices.create') }}" class="flex items-center gap-4 p-4 rounded-xl hover:bg-gray-50 transition-all border border-gray-100">
                    <div class="bg-blue-100 p-2 rounded-lg"><svg class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg></div>
                    <span class="text-sm font-bold">Créer une facture</span>
                </a>
                <a href="{{ route('engineer.profile.edit') }}" class="flex items-center gap-4 p-4 rounded-xl hover:bg-gray-50 transition-all border border-gray-100">
                    <div class="bg-gray-100 p-2 rounded-lg"><svg class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg></div>
                    <span class="text-sm font-bold">Mon profil expert</span>
                </a>
            </div>
        </div>

        <div class="bg-gray-900 text-white p-8 rounded-2xl shadow-xl">
            <p class="text-gray-400 text-xs font-black uppercase mb-2">Note globale</p>
            <h2 class="text-5xl font-bold mb-2">{{ Auth::user()->engineerProfile->rating }}<span class="text-xl text-yellow-400 ml-2">★</span></h2>
            <p class="text-gray-400 text-sm">Basé sur vos dernières interventions</p>
        </div>
    </div>
</div>
@endsection
