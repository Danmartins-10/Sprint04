<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Eventos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-medium text-gray-900">Lista de Eventos</h3>
                    <a href="{{ route('eventos.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-4 py-2 rounded shadow">Novo Evento</a>
                </div>

                <div class="space-y-4">
                    @forelse($eventos as $evento)
                        <div class="border border-gray-200 p-4 rounded-lg flex justify-between items-center shadow-sm">
                            <div>
                                <a href="{{ route('eventos.show', $evento) }}" class="text-blue-600 hover:underline font-bold text-lg">{{ $evento->titulo }}</a>
                                <p class="text-sm text-gray-600 mt-1">Local: {{ $evento->local }} | Data: {{ \Carbon\Carbon::parse($evento->data_evento)->format('d/m/Y H:i') }}</p>
                            </div>
                            <span class="bg-gray-100 text-gray-800 text-xs font-semibold px-2.5 py-1.5 rounded">{{ $evento->perguntas_count }} perguntas</span>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">Nenhum evento cadastrado ainda.</p>
                    @endforelse
                </div>

                <div class="mt-6">
                    {{ $eventos->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
