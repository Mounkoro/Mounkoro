@extends('layouts.app')
@section('title', 'Créer une Facture')
@section('content')
<div class="max-w-4xl mx-auto bg-white p-10 rounded-2xl shadow-xl border border-gray-100">
    <h2 class="text-3xl font-bold mb-8">Générer une Facture</h2>

    <form method="POST" action="{{ route('engineer.invoices.store') }}" id="invoice-form" class="space-y-8">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <label class="block text-sm font-bold mb-2">Sélectionner le client</label>
                <select name="client_id" class="w-full px-4 py-3 rounded-xl border border-gray-200" required>
                    <option value="">-- Choisir un client --</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold mb-2">Montant Total (€)</label>
                <input type="number" step="0.01" name="amount" id="total-amount" class="w-full px-4 py-3 rounded-xl border border-gray-200 font-bold text-primary text-xl bg-gray-50" readonly required>
            </div>
        </div>

        <div class="space-y-4">
            <div class="flex justify-between items-center">
                <h4 class="font-bold uppercase text-xs text-gray-400 tracking-widest">Détails des prestations & matériels</h4>
                <button type="button" onclick="addItem()" class="text-primary font-bold text-sm">+ Ajouter une ligne</button>
            </div>
            <div id="items-container" class="space-y-3">
                <div class="grid grid-cols-12 gap-4 item-row">
                    <div class="col-span-6">
                        <input type="text" name="items[0][description]" class="w-full px-4 py-2 rounded-xl border border-gray-200 text-sm" placeholder="Description..." required>
                    </div>
                    <div class="col-span-2">
                        <input type="number" step="0.01" name="items[0][price]" class="w-full px-4 py-2 rounded-xl border border-gray-200 text-sm item-price" placeholder="Prix" oninput="calculateTotal()" required>
                    </div>
                    <div class="col-span-2">
                        <input type="number" name="items[0][quantity]" class="w-full px-4 py-2 rounded-xl border border-gray-200 text-sm item-qty" placeholder="Qté" oninput="calculateTotal()" value="1" required>
                    </div>
                    <div class="col-span-2"></div>
                </div>
            </div>
        </div>

        <button type="submit" class="w-full bg-primary text-white py-4 rounded-xl font-bold hover:bg-primary-dark transition-all shadow-lg mt-8">Générer la facture officielle</button>
    </form>
</div>

<script>
let itemIndex = 1;
function addItem() {
    const container = document.getElementById('items-container');
    const row = document.createElement('div');
    row.className = 'grid grid-cols-12 gap-4 item-row';
    row.innerHTML = `
        <div class="col-span-6">
            <input type="text" name="items[${itemIndex}][description]" class="w-full px-4 py-2 rounded-xl border border-gray-200 text-sm" placeholder="Description..." required>
        </div>
        <div class="col-span-2">
            <input type="number" step="0.01" name="items[${itemIndex}][price]" class="w-full px-4 py-2 rounded-xl border border-gray-200 text-sm item-price" placeholder="Prix" oninput="calculateTotal()" required>
        </div>
        <div class="col-span-2">
            <input type="number" name="items[${itemIndex}][quantity]" class="w-full px-4 py-2 rounded-xl border border-gray-200 text-sm item-qty" placeholder="Qté" oninput="calculateTotal()" value="1" required>
        </div>
        <div class="col-span-2 flex items-center">
            <button type="button" onclick="this.parentElement.parentElement.remove(); calculateTotal()" class="text-red-500 font-bold text-xs underline">Supprimer</button>
        </div>
    `;
    container.appendChild(row);
    itemIndex++;
}

function calculateTotal() {
    let total = 0;
    const prices = document.querySelectorAll('.item-price');
    const qties = document.querySelectorAll('.item-qty');
    prices.forEach((price, i) => {
        total += (parseFloat(price.value) || 0) * (parseInt(qties[i].value) || 0);
    });
    document.getElementById('total-amount').value = total.toFixed(2);
}
</script>
@endsection
