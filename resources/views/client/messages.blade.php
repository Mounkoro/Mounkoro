@extends('layouts.app')
@section('title', 'Messages')
@section('content')
<div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden h-[600px] flex">
    <div class="w-1/3 border-r border-gray-100 flex flex-col">
        <div class="p-6 bg-gray-50 border-b border-gray-100">
            <h3 class="font-bold">Contacts</h3>
        </div>
        <div class="flex-1 overflow-y-auto">
            @foreach($users as $user)
                <a href="?user_id={{ $user->id }}" class="block p-6 hover:bg-blue-50 border-b border-gray-50 transition-all {{ request('user_id') == $user->id ? 'bg-blue-50 border-r-4 border-primary' : '' }}">
                    <p class="font-bold text-sm">{{ $user->name }}</p>
                    <p class="text-[10px] text-primary font-black uppercase">{{ $user->engineerProfile->skills ?: 'Expert' }}</p>
                </a>
            @endforeach
        </div>
    </div>

    <div class="flex-1 flex flex-col">
        @if(request('user_id'))
            <div class="p-4 bg-white border-b border-gray-100 flex items-center gap-3">
                <div class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center text-primary font-bold">
                    {{ substr($users->find(request('user_id'))->name, 0, 1) }}
                </div>
                <div>
                    <p class="font-bold text-sm">{{ $users->find(request('user_id'))->name }}</p>
                    <p class="text-[10px] text-green-500 font-bold uppercase">En ligne</p>
                </div>
            </div>

            <div id="chat-messages" class="flex-1 overflow-y-auto p-6 bg-gray-50">
                <!-- Messages will load here via JS -->
            </div>

            <form id="chat-form" class="p-4 bg-white border-t border-gray-100 flex gap-4">
                <input type="text" id="chat-input" class="flex-1 bg-gray-100 border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary/20 outline-none" placeholder="Votre message...">
                <button type="submit" class="bg-primary text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:bg-primary-dark transition-all">Envoyer</button>
            </form>
        @else
            <div class="flex-1 flex items-center justify-center text-gray-400 italic">
                Sélectionnez un contact pour démarrer la discussion
            </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
@if(request('user_id'))
<script src="{{ asset('js/chat.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        initChat({{ request('user_id') }}, {{ Auth::id() }});
    });
</script>
@endif
@endsection
