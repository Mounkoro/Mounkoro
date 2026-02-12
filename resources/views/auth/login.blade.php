@extends('layouts.app')
@section('title', 'Connexion')
@section('content')
<div class="max-w-md mx-auto bg-white p-10 rounded-2xl shadow-xl border border-gray-100">
    <div class="text-center mb-10">
        <svg class="h-16 w-16 text-primary mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
        </svg>
        <h2 class="text-3xl font-bold">Connexion</h2>
        <p class="text-gray-500 mt-2">Accédez à votre espace POINT ELECTRIC</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf
        <div>
            <label class="block text-sm font-bold mb-2">Email</label>
            <input type="email" name="email" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all outline-none" required>
        </div>
        <div>
            <label class="block text-sm font-bold mb-2">Mot de passe</label>
            <input type="password" name="password" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all outline-none" required>
        </div>
        @if($errors->any())
            <p class="text-red-500 text-sm italic">{{ $errors->first() }}</p>
        @endif
        <button type="submit" class="w-full bg-primary text-white py-4 rounded-xl font-bold hover:bg-primary-dark transition-all shadow-lg">Se connecter</button>
    </form>

    <p class="text-center mt-8 text-sm text-gray-500">
        Pas encore membre ? <a href="{{ route('register') }}" class="text-primary font-bold hover:underline">Créer un compte</a>
    </p>
</div>
@endsection
