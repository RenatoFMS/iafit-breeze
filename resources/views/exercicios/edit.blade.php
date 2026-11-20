<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar Exercício — {{ $exercicio->nome }}</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-xl shadow-sm border">
                @if ($errors->any())
                    <div class="mb-4 p-4 rounded-lg bg-red-50 text-red-700 text-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('exercicios.update', $exercicio) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nome do Exercício</label>
                        <input type="text" name="nome" value="{{ old('nome', $exercicio->nome) }}" required class="mt-1 w-full rounded-lg border-gray-300">
                    </div>

                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Grupo Muscular</label>
                            <input type="text" name="grupo_muscular" value="{{ old('grupo_muscular', $exercicio->grupo_muscular) }}" required class="mt-1 w-full rounded-lg border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Dificuldade</label>
                            <select name="dificuldade" class="mt-1 w-full rounded-lg border-gray-300">
                                @foreach(['Iniciante', 'Intermediário', 'Avançado'] as $nivel)
                                    <option value="{{ $nivel }}" @selected(old('dificuldade', $exercicio->dificuldade) === $nivel)>{{ $nivel }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Articulações Monitoradas</label>
                        <input type="text" name="articulacoes_monitoradas" value="{{ old('articulacoes_monitoradas', $exercicio->articulacoes_monitoradas) }}" required class="mt-1 w-full rounded-lg border-gray-300">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Ângulo Ideal</label>
                        <input type="text" name="angulo_ideal" value="{{ old('angulo_ideal', $exercicio->angulo_ideal) }}" required class="mt-1 w-full rounded-lg border-gray-300">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Descrição da Correção Postural</label>
                        <textarea name="descricao_correcao" rows="3" required class="mt-1 w-full rounded-lg border-gray-300">{{ old('descricao_correcao', $exercicio->descricao_correcao) }}</textarea>
                    </div>

                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="ativo" id="ativo" @checked(old('ativo', $exercicio->ativo)) class="rounded border-gray-300 text-emerald-600">
                        <label for="ativo" class="text-sm text-gray-700">Exercício ativo no monitoramento</label>
                    </div>

                    <div class="flex justify-end gap-3 pt-4">
                        <a href="{{ route('exercicios.index') }}" class="px-4 py-2 rounded-lg border text-gray-700 text-sm">Cancelar</a>
                        <button type="submit" class="px-5 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>