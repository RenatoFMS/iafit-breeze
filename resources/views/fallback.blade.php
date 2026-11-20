<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 — Página não encontrada | IAFit</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-950 text-slate-100 flex items-center justify-center p-6">
    <div class="max-w-md text-center bg-slate-900 border border-slate-800 rounded-2xl p-8">
        <p class="text-5xl font-extrabold text-emerald-400">404</p>
        <h1 class="mt-4 text-2xl font-bold">Rota não encontrada</h1>
        <p class="mt-2 text-sm text-slate-400">
            A página acessada não existe no sistema IAFit (tratada via <code>Route::fallback</code>).
        </p>
        <a href="{{ route('home') }}" class="mt-6 inline-block px-5 py-2.5 rounded-lg bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-semibold text-sm">
            Voltar para a Página Inicial
        </a>
    </div>
</body>
</html>