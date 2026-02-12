@extends('layouts.app')
@section('title', 'Mon Profil')
@section('content')
<div class="max-w-2xl mx-auto bg-white p-10 rounded-2xl shadow-xl border border-gray-100">
    <h2 class="text-3xl font-bold mb-8">Mon Profil Expert</h2>

    <form method="POST" action="{{ route('engineer.profile.update') }}" class="space-y-6">
        @csrf
        <div>
            <label class="block text-sm font-bold mb-2">Compétences / Spécialités</label>
            <input type="text" name="skills" class="w-full px-4 py-3 rounded-xl border border-gray-200" value="{{ $engineer->skills }}" placeholder="ex: Domotique, Installation industrielle...">
        </div>
        <div>
            <label class="block text-sm font-bold mb-2">Zone d'intervention</label>
            <input type="text" name="intervention_zone" class="w-full px-4 py-3 rounded-xl border border-gray-200" value="{{ $engineer->intervention_zone }}" placeholder="ex: Paris, Lyon et sa région...">
        </div>
        <div>
            <label class="block text-sm font-bold mb-2">Disponibilité</label>
            <select name="availability" class="w-full px-4 py-3 rounded-xl border border-gray-200">
                <option value="disponible" {{ $engineer->availability === 'disponible' ? 'selected' : '' }}>Disponible</option>
                <option value="occupe" {{ $engineer->availability === 'occupe' ? 'selected' : '' }}>Occupé</option>
                <option value="en_vacances" {{ $engineer->availability === 'en_vacances' ? 'selected' : '' }}>En vacances</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-bold mb-2">Biographie</label>
            <textarea name="bio" rows="5" class="w-full px-4 py-3 rounded-xl border border-gray-200" placeholder="Présentez votre expertise aux clients...">{{ $engineer->bio }}</textarea>
        </div>
        <button type="submit" class="w-full bg-primary text-white py-4 rounded-xl font-bold hover:bg-primary-dark transition-all shadow-lg mt-6">Enregistrer les modifications</button>
    </form>
</div>
@endsection
