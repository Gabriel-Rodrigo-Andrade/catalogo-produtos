@extends('layouts.catalog')

@section('title', 'Editar produto')

@section('content')
    <div class="topline">
        <div>
            <h1>Editar produto</h1>
            <p class="muted">Atualize as informações de {{ $product->nome }}.</p>
        </div>
    </div>
    <form class="panel" method="POST" action="{{ route('products.update', $product) }}">
        @csrf
        @method('PUT')
        @include('products._form', ['submitLabel' => 'Salvar alterações'])
    </form>
@endsection
