<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $tcc['nome'] }} — TCC Desenvolvimento de Sistemas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-950 text-slate-100 antialiased">
    <!-- Navbar -->
    <header class="border-b border-slate-800 bg-slate-900/80 backdrop-blur sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="px-2.5 py-1 rounded-lg bg-emerald-500 text-slate-950 font-bold text-sm">IA</span>
                <span class="text-xl font-bold tracking-tight">{{ $tcc['nome'] }}</span>
            </div>

            <nav class="flex items-center gap-4 text-sm font-medium">
                <a href="#sobre" class="text-slate-300 hover:text-emerald-400">Sobre o TCC</a>
                <a href="#arquitetura" class="text-slate-300 hover:text-emerald-400">Tecnologias</a>
                <a href="#exercicios" class="text-slate-300 hover:text-emerald-400">Exercícios ({{ $exercicios->count() }})</a>

                @auth
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-lg bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-semibold">
                        Painel de Controle
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-slate-200 hover:text-emerald-400">Entrar</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 rounded-lg bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-semibold">
                        Registrar
                    </a>
                @endauth
            </nav>
        </div>
    </header>

    <!-- Hero -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="max-w-3xl">
            <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-emerald-500/10 text-emerald-400 border border-emerald-500/30 mb-4">
                {{ $tcc['curso'] }}
            </span>
            <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight text-white">
                {{ $tcc['nome'] }}: {{ $tcc['subtitulo'] }}
            </h1>
            <p class="mt-6 text-lg text-slate-300 leading-relaxed">
                {{ $tcc['objetivo'] }}
            </p>
            <div class="mt-8 flex flex-wrap gap-4">
                <a href="{{ route('dashboard') }}" class="px-6 py-3 rounded-lg bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-semibold">
                    Acessar Painel e CRUD
                </a>
                <a href="#exercicios" class="px-6 py-3 rounded-lg border border-slate-700 hover:border-emerald-400 text-slate-200 font-semibold">
                    Ver Base de Exercícios
                </a>
            </div>
        </div>
    </section>

    <!-- Dados Completos do TCC -->
    <section id="sobre" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 grid md:grid-cols-2 gap-6">
        <div class="p-6 rounded-2xl bg-slate-900 border border-slate-800">
            <h2 class="text-xl font-bold text-emerald-400 mb-3">Problema Identificado</h2>
            <p class="text-slate-300 leading-relaxed">{{ $tcc['problema'] }}</p>
        </div>

        <div class="p-6 rounded-2xl bg-slate-900 border border-slate-800">
            <h2 class="text-xl font-bold text-emerald-400 mb-3">Diferenciais do Sistema</h2>
            <ul class="space-y-2 text-slate-300 list-disc list-inside">
                @foreach($tcc['diferenciais'] as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        </div>
    </section>

    <!-- Stack Tecnológica -->
    <section id="arquitetura" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="p-6 rounded-2xl bg-slate-900 border border-slate-800">
            <h2 class="text-xl font-bold text-white mb-4">Stack e Arquitetura do Projeto</h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach($tcc['tecnologias'] as $tech)
                    <div class="p-4 rounded-xl bg-slate-950 border border-slate-800 text-sm text-slate-300">
                        {{ $tech }}
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Base de Exercícios do Banco de Dados -->
    <section id="exercicios" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-white">Exercícios Monitorados pelo IAFit</h2>
                <p class="text-sm text-slate-400">Dados carregados dinamicamente do banco de dados via Laravel.</p>
            </div>
            <span class="px-3 py-1 rounded-full bg-slate-800 text-emerald-400 text-sm font-semibold">
                Total: {{ $exercicios->count() }} registros
            </span>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($exercicios as $exercicio)
                <div class="p-6 rounded-2xl bg-slate-900 border border-slate-800 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between gap-2 mb-3">
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-emerald-500/10 text-emerald-400">
                                {{ $exercicio->dificuldade }}
                            </span>
                            <span class="text-xs text-slate-400">{{ $exercicio->grupo_muscular }}</span>
                        </div>
                        <h3 class="text-lg font-bold text-white">{{ $exercicio->nome }}</h3>
                        <p class="mt-2 text-sm text-slate-300">{{ $exercicio->descricao_correcao }}</p>
                    </div>
                    <div class="mt-4 pt-4 border-t border-slate-800 text-xs text-slate-400 space-y-1">
                        <p><strong class="text-slate-200">Articulações:</strong> {{ $exercicio->articulacoes_monitoradas }}</p>
                        <p><strong class="text-slate-200">Ângulo Ideal:</strong> {{ $exercicio->angulo_ideal }}</p>
                    </div>
                </div>
            @empty
                <p class="text-slate-400">Nenhum exercício cadastrado ainda.</p>
            @endforelse
        </div>
    </section>

    <footer class="border-t border-slate-800 py-6 text-center text-xs text-slate-500">
        TCC {{ $tcc['nome'] }} • Desenvolvido com Laravel Breeze & Tailwind CSS
    </footer>
</body>
</html>