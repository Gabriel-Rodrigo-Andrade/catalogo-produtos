@extends('layouts.catalog')

@section('title', 'Cadastrar produto')

@section('content')
    <div class="topline">
        <div>
            <h1>Novo produto</h1>
            <p class="muted">Informe os dados do produto para adicioná-lo ao catálogo.</p>
        </div>
    </div>
    <form class="panel" method="POST" action="{{ route('products.store') }}">
        @csrf
        @include('products._form', ['product' => null, 'submitLabel' => 'Salvar produto'])
    </form>
@endsection
