@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-6"></h1>

    <!-- Primeira Fileira: Produtos e Vendas -->
    <div class="grid grid-cols-2 gap-6 mb-6">
        <!-- Card Produtos -->
        <div class="bg-white border border-black rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold text-black mb-4">Produtos</h2>
            <p class="text-gray-700">Confira os produtos disponíveis no sistema.</p>
        </div>

        <!-- Card Vendas -->
        <div class="bg-white border border-black rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold text-black mb-4">Vendas</h2>
            <p class="text-gray-700">Acompanhe o histórico de vendas e relatórios.</p>
        </div>
    </div>

    <!-- Segunda Fileira: Usuários e Links -->
    <div class="grid grid-cols-2 gap-6">
        <!-- Card Usuários -->
        <div class="bg-white border border-black rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold text-black mb-4">Usuários</h2>
            <p class="text-gray-700">Gerencie e visualize os usuários cadastrados.</p>
        </div>

        <!-- Card Links -->
        <div class="bg-white border border-black rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold text-black mb-4">Links</h2>
            <p class="text-gray-700">Gerencie os links úteis para sua equipe ou clientes.</p>
        </div>
    </div>
</div>
@endsection
