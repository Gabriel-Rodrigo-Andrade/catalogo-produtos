@if ($errors->any())
    <div class="alert" role="alert" style="background:#fff0f1;color:#9e2637">
        Revise os campos destacados e tente novamente.
    </div>
@endif

<div class="field">
    <label for="nome">Nome</label>
    <input id="nome" name="nome" value="{{ old('nome', $product?->nome) }}" required maxlength="255" autocomplete="off">
    @error('nome') <div class="error">{{ $message }}</div> @enderror
</div>

<div class="field">
    <label for="descricao">Descrição</label>
    <textarea id="descricao" name="descricao">{{ old('descricao', $product?->descricao) }}</textarea>
    @error('descricao') <div class="error">{{ $message }}</div> @enderror
</div>

<div class="field">
    <label for="preco">Preço (R$)</label>
    <input id="preco" name="preco" type="number" min="0.01" step="0.01" value="{{ old('preco', $product?->preco) }}" required>
    @error('preco') <div class="error">{{ $message }}</div> @enderror
</div>

<div class="field">
    <label for="estoque">Quantidade em estoque</label>
    <input id="estoque" name="estoque" type="number" min="0" step="1" value="{{ old('estoque', $product?->estoque ?? 0) }}" required>
    @error('estoque') <div class="error">{{ $message }}</div> @enderror
</div>

<div class="actions">
    <button class="button" type="submit">{{ $submitLabel }}</button>
    <a class="button secondary" href="{{ route('products.index') }}">Cancelar</a>
</div>
