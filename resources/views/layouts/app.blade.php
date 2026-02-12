<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')
</head>
<body class="bg-gray-50 text-gray-900 font-sans">
    <nav class="bg-white border-b border-gray-100 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="/" class="flex items-center gap-2">
                    <svg class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    <span class="text-xl font-bold tracking-tight">POINT ELECTRIC</span>
                </a>

                <div class="hidden md:flex space-x-8 items-center">
                    @auth
                        @if(Auth::user()->role === 'client')
                            <a href="{{ route('client.dashboard') }}" class="text-sm font-medium hover:text-primary transition-all">Tableau de bord</a>
                            <a href="{{ route('client.engineers') }}" class="text-sm font-medium hover:text-primary transition-all">Experts</a>
                            <a href="{{ route('client.messages') }}" class="text-sm font-medium hover:text-primary transition-all">Messages</a>
                        @else
                            <a href="{{ route('engineer.dashboard') }}" class="text-sm font-medium hover:text-primary transition-all">Espace Expert</a>
                            <a href="{{ route('engineer.appointments') }}" class="text-sm font-medium hover:text-primary transition-all">Rendez-vous</a>
                            <a href="{{ route('engineer.messages') }}" class="text-sm font-medium hover:text-primary transition-all">Messages</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-700">Déconnexion</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium hover:text-primary">Connexion</a>
                        <a href="{{ route('register') }}" class="bg-primary text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-primary-dark transition-all shadow-md">S'inscrire</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-8 flex items-center shadow-sm">
                    <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M5 13l4 4L19 7" /></svg>
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <footer class="bg-white border-t border-gray-100 py-12 mt-20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-gray-500 text-sm">&copy; {{ date('Y') }} POINT ELECTRIC. Tous droits réservés.</p>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>
