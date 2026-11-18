<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventoFormRequest;
use App\Http\Requests\StorePerguntaRequest;
use App\Models\Evento;
use App\Models\Pergunta;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EventoController extends Controller
{
    public function index(): View
    {
        $eventos = Evento::withCount('perguntas')->latest()->paginate(10);
        return view('eventos.index', compact('eventos'));
    }

    public function create(): View
    {
        return view('eventos.create');
    }

    public function store(EventoFormRequest $request): RedirectResponse
    {
        Evento::create($request->validated());

        return redirect()->route('eventos.index')
            ->with('success', 'Evento criado com sucesso!');
    }

    public function show(Evento $evento): View
    {
        $evento->load('perguntas');
        return view('eventos.show', compact('evento'));
    }

    public function storePergunta(StorePerguntaRequest $request, Evento $evento): RedirectResponse
    {
        $evento->perguntas()->create($request->validated());

        return redirect()->route('eventos.show', $evento)
            ->with('success', 'Pergunta enviada com sucesso!');
    }
}
