@extends('layouts.app')
@section('title', 'Experts')
@section('content')
<div class="mb-10">
    <h2 class="text-3xl font-bold mb-4">Nos Experts Électriciens</h2>
    <form action="{{ route('client.engineers') }}" method="GET" class="relative max-w-xl">
        <input type="text" name="search" placeholder="Rechercher par nom, ville ou compétence..." class="w-full pl-12 pr-4 py-4 rounded-2xl border-none shadow-lg focus:ring-2 focus:ring-primary/20 outline-none" value="{{ request('search') }}">
        <svg class="h-6 w-6 absolute left-4 top-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
    </form>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @foreach($engineers as $engineer)
    <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm hover-scale transition-all">
        <div class="flex justify-between items-start mb-6">
            <div class="bg-primary/10 p-4 rounded-2xl">
                <svg class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
            </div>
            <span class="bg-green-100 text-green-700 text-[10px] font-black uppercase px-2 py-1 rounded-full">{{ $engineer->availability }}</span>
        </div>
        <h3 class="text-xl font-bold">{{ $engineer->user->name }}</h3>
        <p class="text-primary text-sm font-bold mt-1">{{ $engineer->skills ?: 'Électricité Générale' }}</p>
        <p class="text-gray-500 text-xs mt-4 flex items-center"><svg class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /></svg> {{ $engineer->intervention_zone ?: 'France entière' }}</p>

        <div class="flex gap-4 mt-8">
            <a href="{{ route('client.requests.create') }}" class="flex-1 bg-primary text-white text-center py-3 rounded-xl text-sm font-bold hover:bg-primary-dark">Devis</a>
            <a href="{{ route('client.messages') }}?user_id={{ $engineer->user_id }}" class="px-4 bg-gray-50 text-gray-600 flex items-center justify-center rounded-xl border border-gray-100 hover:bg-gray-100">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
            </a>
        </div>
    </div>
    @endforeach
</div>
@endsection
