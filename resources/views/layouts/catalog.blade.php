<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Catálogo de produtos')</title>
    <style>
        :root { color-scheme: light; font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif; color: #172033; background: #f4f6fb; }
        * { box-sizing: border-box; }
        body { margin: 0; }
        header { background: #172033; color: #fff; }
        nav, main { width: min(1080px, calc(100% - 32px)); margin: 0 auto; }
        nav { min-height: 68px; display: flex; align-items: center; justify-content: space-between; }
        nav a { color: #fff; text-decoration: none; font-weight: 700; }
        main { padding: 36px 0 64px; }
        h1 { margin: 0 0 8px; font-size: clamp(1.8rem, 4vw, 2.5rem); }
        p { line-height: 1.55; }
        .muted { color: #647089; }
        .topline { display: flex; justify-content: space-between; align-items: center; gap: 16px; margin-bottom: 24px; }
        .button { display: inline-flex; align-items: center; justify-content: center; border: 0; border-radius: 9px; background: #3157d5; color: white; padding: 11px 16px; text-decoration: none; font: inherit; font-weight: 650; cursor: pointer; }
        .button.secondary { background: #e8ecf5; color: #23304b; }
        .button.danger { background: #b83248; }
        .grid { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); align-items: stretch; gap: 16px; }
        .card, .panel { background: #fff; border: 1px solid #e4e8f0; border-radius: 14px; padding: 20px; box-shadow: 0 4px 16px #16234708; }
        .card { display: flex; min-width: 0; flex-direction: column; }
        .card h2 { margin: 0 0 8px; font-size: 1.15rem; overflow-wrap: anywhere; }
        .card p { flex: 1; }
        .price { font-size: 1.3rem; font-weight: 750; }
        .stock { display: inline-block; margin: 8px 0 16px; padding: 5px 9px; border-radius: 999px; background: #eef2ff; color: #344db1; font-size: .85rem; }
        .actions { display: flex; flex-wrap: wrap; align-items: center; gap: 9px; }
        .card .actions { margin-top: auto; }
        .actions form { margin: 0; }
        .field { margin: 0 0 18px; }
        label { display: block; margin-bottom: 6px; font-weight: 650; }
        input, textarea { width: 100%; border: 1px solid #cbd3e2; border-radius: 8px; padding: 11px 12px; color: inherit; font: inherit; background: #fff; }
        textarea { min-height: 110px; resize: vertical; }
        .error { margin-top: 5px; color: #b83248; font-size: .9rem; }
        .alert { margin-bottom: 20px; padding: 12px 15px; border-radius: 9px; background: #e7f7ed; color: #1d6737; }
        .empty { grid-column: 1 / -1; text-align: center; padding: 48px 20px; }
        .details { display: grid; grid-template-columns: max-content 1fr; gap: 12px 20px; }
        .details dt { color: #647089; }
        .details dd { margin: 0; font-weight: 600; }
        .pagination { margin-top: 24px; }
        @media (max-width: 900px) { .grid { grid-template-columns: repeat(3, minmax(0, 1fr)); } }
        @media (max-width: 680px) {
            nav, main { width: min(100% - 28px, 540px); }
            .grid { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 12px; }
            .card, .panel { padding: 16px; }
            .topline { align-items: flex-start; flex-direction: column; }
            main { padding-top: 26px; }
        }
        @media (max-width: 420px) {
            nav, main { width: calc(100% - 24px); }
            nav { min-height: 60px; }
            nav a { font-size: .92rem; }
            .grid { grid-template-columns: minmax(0, 1fr); gap: 12px; }
            .card, .panel { padding: 18px; }
            .actions .button { flex: 1; }
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <a href="{{ route('products.index') }}">Catálogo</a>
            <a href="{{ route('products.create') }}">Cadastrar produto</a>
        </nav>
    </header>
    <main>
        @if (session('success'))
            <div class="alert" role="status">{{ session('success') }}</div>
        @endif
        @yield('content')
    </main>
</body>
</html>
