<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Painel de Controle — TCC {{ $tcc['nome'] }}
            </h2>
            <a href="{{ route('exercicios.create') }}" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-lg">
                + Novo Exercício
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Métricas -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white p-5 rounded-xl shadow-sm border">
                    <p class="text-xs uppercase text-gray-500 font-semibold">Total de Exercícios</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ $metricas['total_exercicios'] }}</p>
                </div>
                <div class="bg-white p-5 rounded-xl shadow-sm border">
                    <p class="text-xs uppercase text-gray-500 font-semibold">Exercícios Ativos</p>
                    <p class="text-3xl font-bold text-emerald-600 mt-1">{{ $metricas['ativos'] }}</p>
                </div>
                <div class="bg-white p-5 rounded-xl shadow-sm border">
                    <p class="text-xs uppercase text-gray-500 font-semibold">Nível Avançado</p>
                    <p class="text-3xl font-bold text-indigo-600 mt-1">{{ $metricas['avancados'] }}</p>
                </div>
                <div class="bg-white p-5 rounded-xl shadow-sm border">
                    <p class="text-xs uppercase text-gray-500 font-semibold">Usuários Cadastrados</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ $metricas['total_usuarios'] }}</p>
                </div>
            </div>

            <!-- Visão Geral Completa do TCC -->
            <div class="bg-white p-6 rounded-xl shadow-sm border space-y-4">
                <h3 class="text-lg font-bold text-gray-900">{{ $tcc['nome'] }} — {{ $tcc['subtitulo'] }}</h3>
                <p class="text-sm text-gray-600"><strong>Instituição:</strong> {{ $tcc['curso'] }}</p>
                <div class="grid md:grid-cols-2 gap-4 text-sm text-gray-700">
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <h4 class="font-semibold text-gray-900 mb-1">Problema</h4>
                        <p>{{ $tcc['problema'] }}</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <h4 class="font-semibold text-gray-900 mb-1">Objetivo</h4>
                        <p>{{ $tcc['objetivo'] }}</p>
                    </div>
                </div>
                <div>
                    <h4 class="font-semibold text-sm text-gray-900 mb-2">Tecnologias Utilizadas:</h4>
                    <div class="flex flex-wrap gap-2">
                        @foreach($tcc['tecnologias'] as $tech)
                            <span class="px-3 py-1 text-xs rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">
                                {{ $tech }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Tabela Resumo dos Dados do Banco com Acesso ao CRUD -->
            <div class="bg-white p-6 rounded-xl shadow-sm border">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-900">Exercícios Cadastrados no Banco</h3>
                    <a href="{{ route('exercicios.index') }}" class="text-sm text-emerald-600 hover:underline font-medium">
                        Gerenciar CRUD Completo →
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                            <tr>
                                <th class="px-4 py-3">ID</th>
                                <th class="px-4 py-3">Exercício</th>
                                <th class="px-4 py-3">Grupo Muscular</th>
                                <th class="px-4 py-3">Ângulo Ideal</th>
                                <th class="px-4 py-3">Dificuldade</th>
                                <th class="px-4 py-3 text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @foreach($exercicios as $exercicio)
                                <tr>
                                    <td class="px-4 py-3 font-medium">#{{ $exercicio->id }}</td>
                                    <td class="px-4 py-3 font-semibold text-gray-900">{{ $exercicio->nome }}</td>
                                    <td class="px-4 py-3">{{ $exercicio->grupo_muscular }}</td>
                                    <td class="px-4 py-3">{{ $exercicio->angulo_ideal }}</td>
                                    <td class="px-4 py-3">{{ $exercicio->dificuldade }}</td>
                                    <td class="px-4 py-3 text-right space-x-2">
                                        <a href="{{ route('exercicios.edit', $exercicio) }}" class="text-indigo-600 hover:underline">Editar</a>
                                        <form action="{{ route('exercicios.destroy', $exercicio) }}" method="POST" class="inline" onsubmit="return confirm('Excluir este exercício?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>