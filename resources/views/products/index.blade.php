@extends('layouts.catalog')

@section('title', 'Catálogo de produtos')

@section('content')
    <div class="topline">
        <div>
            <h1>Catálogo de produtos</h1>
            <p class="muted">Consulte os produtos, preços e disponibilidade em estoque.</p>
        </div>
        <a class="button" href="{{ route('products.create') }}">Adicionar produto</a>
    </div>

    <section class="grid" aria-label="Produtos cadastrados">
        @forelse ($products as $product)
            <article class="card">
                <h2>{{ $product->nome }}</h2>
                <p class="muted">{{ Str::limit($product->descricao ?: 'Sem descrição cadastrada.', 110) }}</p>
                <div class="price">R$ {{ number_format((float) $product->preco, 2, ',', '.') }}</div>
                <span class="stock">{{ $product->estoque }} em estoque</span>
                <div class="actions">
                    <a class="button secondary" href="{{ route('products.show', $product) }}">Detalhes</a>
                    <a class="button secondary" href="{{ route('products.edit', $product) }}">Editar</a>
                </div>
            </article>
        @empty
            <div class="panel empty">
                <h2>Seu catálogo está vazio</h2>
                <p class="muted">Cadastre o primeiro produto para exibi-lo aqui.</p>
                <a class="button" href="{{ route('products.create') }}">Cadastrar produto</a>
            </div>
        @endforelse
    </section>

    <div class="pagination">{{ $products->links() }}</div>
@endsection
