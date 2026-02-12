@extends('layouts.app')
@section('title', 'Nouvelle Demande')
@section('content')
<div class="max-w-2xl mx-auto bg-white p-10 rounded-2xl shadow-xl border border-gray-100">
    <h2 class="text-3xl font-bold mb-8 text-center">Nouvelle Demande</h2>

    <form method="POST" action="{{ route('client.requests.store') }}" class="space-y-6">
        @csrf
        <div>
            <label class="block text-sm font-bold mb-2">Type d'intervention</label>
            <select name="type" class="w-full px-4 py-3 rounded-xl border border-gray-200 outline-none focus:border-primary">
                <option value="devis">Demande de devis</option>
                <option value="urgence">Dépannage en urgence 24/7</option>
                <option value="installation">Installation électrique complète</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-bold mb-2">Description</label>
            <textarea name="description" rows="5" class="w-full px-4 py-3 rounded-xl border border-gray-200 outline-none focus:border-primary" placeholder="Décrivez votre besoin en détail..." required></textarea>
        </div>
        <div>
            <label class="block text-sm font-bold mb-2">Localisation</label>
            <div class="flex gap-2">
                <input type="text" name="location" id="location" class="flex-1 px-4 py-3 rounded-xl border border-gray-200 outline-none focus:border-primary" placeholder="Votre adresse ou coordonnées">
                <button type="button" onclick="getLocation()" class="px-4 bg-gray-50 text-primary border border-gray-100 rounded-xl hover:bg-gray-100">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /></svg>
                </button>
            </div>
        </div>
        <button type="submit" class="w-full bg-primary text-white py-4 rounded-xl font-bold hover:bg-primary-dark transition-all shadow-lg mt-6">Envoyer la demande</button>
    </form>
</div>

<script>
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            document.getElementById('location').value = position.coords.latitude + ", " + position.coords.longitude;
        });
    } else {
        alert("La géolocalisation n'est pas supportée par ce navigateur.");
    }
}
</script>
@endsection
