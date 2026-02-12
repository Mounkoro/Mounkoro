@extends('layouts.app')
@section('title', 'Inscription')
@section('content')
<div class="max-w-md mx-auto bg-white p-10 rounded-2xl shadow-xl border border-gray-100">
    <div class="text-center mb-10">
        <h2 class="text-3xl font-bold">Inscription</h2>
        <p class="text-gray-500 mt-2">Rejoignez POINT ELECTRIC dès aujourd'hui</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-bold mb-1">Nom complet</label>
            <input type="text" name="name" class="w-full px-4 py-2 rounded-xl border border-gray-200 outline-none focus:border-primary" required>
        </div>
        <div>
            <label class="block text-sm font-bold mb-1">Email</label>
            <input type="email" name="email" class="w-full px-4 py-2 rounded-xl border border-gray-200 outline-none focus:border-primary" required>
        </div>
        <div>
            <label class="block text-sm font-bold mb-1">Mot de passe</label>
            <input type="password" name="password" class="w-full px-4 py-2 rounded-xl border border-gray-200 outline-none focus:border-primary" required>
        </div>
        <div>
            <label class="block text-sm font-bold mb-1">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" class="w-full px-4 py-2 rounded-xl border border-gray-200 outline-none focus:border-primary" required>
        </div>
        <div class="pt-2">
            <span class="block text-sm font-bold mb-2">Vous êtes :</span>
            <div class="flex gap-6">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="role" value="client" checked class="text-primary">
                    <span class="text-sm">Particulier (Client)</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="role" value="engineer" class="text-primary">
                    <span class="text-sm">Expert Électricien</span>
                </label>
            </div>
        </div>
        <button type="submit" class="w-full bg-primary text-white py-4 rounded-xl font-bold hover:bg-primary-dark transition-all shadow-lg mt-4">S'inscrire</button>
    </form>
</div>
@endsection
