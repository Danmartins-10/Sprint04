<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $evento->titulo }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-2">Detalhes do Evento</h3>
                <p class="text-gray-700 mb-2"><strong>Descrição:</strong> {{ $evento->descricao ?? 'Nenhuma descrição informada.' }}</p>
                <p class="text-gray-700 mb-2"><strong>Local:</strong> {{ $evento->local }}</p>
                <p class="text-gray-700 mb-4"><strong>Data:</strong> {{ \Carbon\Carbon::parse($evento->data_evento)->format('d/m/Y H:i') }}</p>
                <a href="{{ route('eventos.index') }}" class="text-blue-600 hover:underline text-sm">&larr; Voltar para a lista</a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Enviar uma Pergunta</h3>

                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <form action="{{ route('eventos.perguntas.store', $evento) }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="autor" class="block font-medium text-sm text-gray-700">Seu Nome (Opcional)</label>
                        <input type="text" name="autor" id="autor" value="{{ old('autor') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('autor') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="texto_pergunta" class="block font-medium text-sm text-gray-700">Pergunta</label>
                        <textarea name="texto_pergunta" id="texto_pergunta" rows="3" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('texto_pergunta') }}</textarea>
                        @error('texto_pergunta') <span class="text-red-500 text-xs">{{ $message}</span> @enderror
                    </div>

                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded font-semibold shadow">Enviar Pergunta</button>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Perguntas Recebidas</h3>
                <div class="space-y-3">
                    @forelse($evento->perguntas as $pergunta)
                        <div class="border-l-4 border-indigo-500 bg-gray-50 p-4 rounded shadow-sm">
                            <p class="text-gray-800">{{ $pergunta->texto_pergunta }}</p>
                            <span class="text-xs text-gray-500 mt-2 block">Por: {{ $pergunta->autor ?: 'Anônimo' }} em {{ $pergunta->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                    @empty
                        <p class="text-gray-500">Ainda não há perguntas para este evento.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
