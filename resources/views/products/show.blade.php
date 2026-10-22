@extends('layouts.catalog')

@section('title', $product->nome)

@section('content')
    <div class="topline">
        <div>
            <p class="muted">Detalhes do produto</p>
            <h1>{{ $product->nome }}</h1>
        </div>
        <div class="actions">
            <a class="button secondary" href="{{ route('products.index') }}">Voltar ao catálogo</a>
            <a class="button" href="{{ route('products.edit', $product) }}">Editar produto</a>
        </div>
    </div>

    <section class="panel">
        <dl class="details">
            <dt>Descrição</dt>
            <dd>{{ $product->descricao ?: 'Sem descrição cadastrada.' }}</dd>
            <dt>Preço</dt>
            <dd>R$ {{ number_format((float) $product->preco, 2, ',', '.') }}</dd>
            <dt>Estoque disponível</dt>
            <dd>{{ $product->estoque }} unidade(s)</dd>
        </dl>
    </section>

    <form style="margin-top:16px" method="POST" action="{{ route('products.destroy', $product) }}" onsubmit="return confirm('Remover este produto do catálogo?')">
        @csrf
        @method('DELETE')
        <button class="button danger" type="submit">Excluir produto</button>
    </form>
@endsection
