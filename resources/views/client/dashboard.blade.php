@extends('layouts.app')
@section('title', 'Tableau de bord')
@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    <div class="md:col-span-2 space-y-8">
        <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold">Vos Demandes Récentes</h3>
                <a href="{{ route('client.requests.create') }}" class="text-primary font-bold text-sm hover:underline">+ Nouvelle demande</a>
            </div>
            <div class="divide-y divide-gray-50">
                @forelse($requests as $request)
                    <div class="py-4 flex justify-between items-center">
                        <div>
                            <p class="font-bold capitalize">{{ $request->type }}</p>
                            <p class="text-sm text-gray-500 line-clamp-1">{{ $request->description }}</p>
                        </div>
                        <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase {{ $request->status === 'en_attente' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700' }}">
                            {{ str_replace('_', ' ', $request->status) }}
                        </span>
                    </div>
                @empty
                    <p class="text-gray-400 text-center py-4 italic">Aucune demande pour le moment.</p>
                @endforelse
            </div>
        </div>

        <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm">
            <h3 class="text-xl font-bold mb-6">Factures à régler</h3>
            <div class="divide-y divide-gray-50">
                @forelse($invoices as $invoice)
                    <div class="py-4 flex justify-between items-center">
                        <div>
                            <p class="font-bold">Facture #{{ $invoice->id }}</p>
                            <p class="text-sm text-gray-500">Expert: {{ $invoice->engineer->user->name }}</p>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-lg text-primary">{{ $invoice->amount }}€</p>
                            <span class="text-[10px] font-black uppercase text-red-500">À payer</span>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-400 text-center py-4 italic">Aucune facture en attente.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="space-y-8">
        <div class="bg-primary text-white p-8 rounded-2xl shadow-xl">
            <h3 class="text-xl font-bold mb-4">Besoin d'aide ?</h3>
            <p class="text-sm opacity-80 mb-6">Trouvez rapidement un expert électricien certifié près de chez vous.</p>
            <a href="{{ route('client.engineers') }}" class="block w-full text-center bg-white text-primary py-3 rounded-xl font-bold hover:bg-gray-50 transition-all">Rechercher un expert</a>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <h4 class="font-bold mb-4">Mes infos</h4>
            <p class="text-sm text-gray-600 mb-1"><strong>Nom:</strong> {{ Auth::user()->name }}</p>
            <p class="text-sm text-gray-600"><strong>Email:</strong> {{ Auth::user()->email }}</p>
        </div>
    </div>
</div>
@endsection
