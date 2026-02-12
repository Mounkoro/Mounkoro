@extends('layouts.app')
@section('title', 'Accueil')
@section('content')
<div class="text-center py-20 px-4">
    <div class="inline-block bg-primary/10 text-primary px-4 py-2 rounded-full text-xs font-black uppercase tracking-widest mb-6">Expertise Électrique 24/7</div>
    <h1 class="text-5xl md:text-7xl font-black text-gray-900 leading-tight mb-8">
        L'Électricité de Demain,<br>
        <span class="text-primary">Aujourd'hui.</span>
    </h1>
    <p class="text-xl text-gray-500 max-w-2xl mx-auto mb-12">
        Mise en relation directe entre particuliers et experts électriciens qualifiés pour tous vos besoins en installation et dépannage.
    </p>

    <div class="flex flex-wrap justify-center gap-6">
        <a href="{{ route('register') }}" class="bg-primary text-white px-8 py-5 rounded-2xl font-bold text-lg hover:bg-primary-dark transition-all shadow-xl hover-scale">Trouver un expert</a>
        <a href="{{ route('register') }}" class="bg-white text-primary border-2 border-primary px-8 py-5 rounded-2xl font-bold text-lg hover:bg-gray-50 transition-all hover-scale">Je suis électricien</a>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-12 mt-20">
    <div class="bg-white p-10 rounded-3xl border border-gray-100 shadow-sm text-center hover-scale transition-all">
        <div class="bg-blue-50 w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-6 text-primary">
            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04M12 21.48c-4.246-1.5-7.618-5.343-8.618-9.61h17.236c-1 4.267-4.372 8.11-8.618 9.61z" /></svg>
        </div>
        <h3 class="text-xl font-bold mb-4">Experts Certifiés</h3>
        <p class="text-gray-500 text-sm">Tous nos intervenants sont rigoureusement sélectionnés et certifiés.</p>
    </div>
    <div class="bg-white p-10 rounded-3xl border border-gray-100 shadow-sm text-center hover-scale transition-all">
        <div class="bg-blue-50 w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-6 text-primary">
            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        </div>
        <h3 class="text-xl font-bold mb-4">Service 24/7</h3>
        <p class="text-gray-500 text-sm">Dépannage en urgence à tout moment pour assurer votre confort.</p>
    </div>
    <div class="bg-white p-10 rounded-3xl border border-gray-100 shadow-sm text-center hover-scale transition-all">
        <div class="bg-blue-50 w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-6 text-primary">
            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
        </div>
        <h3 class="text-xl font-bold mb-4">Transparence</h3>
        <p class="text-gray-500 text-sm">Devis clairs et détaillés avant chaque intervention, sans surprise.</p>
    </div>
</div>
@endsection
