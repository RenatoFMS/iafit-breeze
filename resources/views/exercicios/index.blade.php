<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                CRUD de Exercícios — IAFit
            </h2>
            <a href="{{ route('exercicios.create') }}" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-lg">
                + Cadastrar Exercício
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 p-4 rounded-lg bg-emerald-100 border border-emerald-300 text-emerald-800 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm rounded-xl border overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-3">Nome</th>
                            <th class="px-4 py-3">Grupo Muscular</th>
                            <th class="px-4 py-3">Articulações</th>
                            <th class="px-4 py-3">Ângulo Ideal</th>
                            <th class="px-4 py-3">Dificuldade</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3 text-right">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($exercicios as $exercicio)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 font-semibold text-gray-900">{{ $exercicio->nome }}</td>
                                <td class="px-4 py-3">{{ $exercicio->grupo_muscular }}</td>
                                <td class="px-4 py-3">{{ $exercicio->articulacoes_monitoradas }}</td>
                                <td class="px-4 py-3">{{ $exercicio->angulo_ideal }}</td>
                                <td class="px-4 py-3">{{ $exercicio->dificuldade }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 text-xs rounded-full {{ $exercicio->ativo ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-200 text-gray-600' }}">
                                        {{ $exercicio->ativo ? 'Ativo' : 'Inativo' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-right space-x-3 whitespace-nowrap">
                                    <a href="{{ route('exercicios.edit', $exercicio) }}" class="text-indigo-600 hover:underline font-medium">Editar</a>
                                    <form action="{{ route('exercicios.destroy', $exercicio) }}" method="POST" class="inline" onsubmit="return confirm('Confirmar exclusão?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline font-medium">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-6 text-center text-gray-500">Nenhum exercício encontrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>