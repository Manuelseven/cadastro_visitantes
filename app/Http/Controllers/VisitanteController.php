<?php

namespace App\Http\Controllers;

use App\Models\Visitante;
use Exception;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;



class VisitanteController extends Controller
{
    public function index(Request $request)
    {
        $query = Visitante::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nome', 'like', "%{$search}%")
                ->orWhere('rg', 'like', "%{$search}%")
                ->orWhere('empresa', 'like', "%{$search}%")
                ->orWhere('pessoa_visitada', 'like', "%{$search}%");
        }


        $visitantes = $query->paginate(10);

        return view('visitantes.index', compact('visitantes'));
    }

    public function create()
    {
        return view('visitantes.create');
    }

    public function store(Request $request, FlasherInterface $flasher)
    {
        $validated = $request->validate([
            'nome' => 'required|string',
            'data' => 'required|date',
            'rg' => 'required|string',
            'hora_entrada' => 'required',
            'hora_saida' => 'nullable',
            'empresa' => 'required|string',
            'pessoa_visitada' => 'required|string',
        ]);

        try {
            Visitante::create($validated);
            $flasher->options([
                'timeout' => 2000,
                'position' => 'top-right',
            ])->success('Visitante criado com sucesso.');
            return redirect()->route('visitantes.index');
        } catch (Exception $e) {
            $flasher->options([
                'timeout' => 2000,
                'position' => 'top-right',
            ])->error('Erro ao criar o visitante.' . $e);
        }
    }

    public function edit(Visitante $visitante)
    {
        return view('visitantes.edit', compact('visitante'));
    }

    public function update(Request $request, Visitante $visitante, FlasherInterface $flasher)
    {
        $validated = $request->validate([
            'nome' => 'required|string',
            'data' => 'required|date',
            'rg' => 'required|string',
            'hora_entrada' => 'required',
            'hora_saida' => 'nullable',
            'empresa' => 'required|string',
            'pessoa_visitada' => 'required|string',
        ]);


        try {
            $visitante->update($validated);
            $flasher->options([
                'timeout' => 2000,
                'position' => 'top-right',
                'title' => 'Sucesso'
            ])->success('Visitante editado com sucesso.');
            return redirect()->route('visitantes.index');
        } catch (Exception $e) {
            $flasher->options([
                'timeout' => 2000,
                'position' => 'top-right',
            ])->error('Erro ao editado o visitante.' . $e);
        }

        return redirect()->route('visitantes.index');
    }

    public function destroy(Visitante $visitante, FlasherInterface $flasher)
    {
        try {
            $visitante->delete();
            $flasher->options([
                'timeout' => 2000,
                'position' => 'top-right',
            ])->success('Visitante deletado com sucesso.');
            return redirect()->route('visitantes.index');
        } catch (Exception $e) {
            $flasher->options([
                'timeout' => 2000,
                'position' => 'top-right',
            ])->error('Erro ao deletar o visitante.' . $e);
        }
    }



    public function search(Request $request)
    {
        $query = $request->get('query');
        $visitantes = Visitante::where('nome', 'like', "%{$query}%")
            ->orWhere('rg', 'like', "%{$query}%")
            ->paginate(10);

        return response()->json($visitantes);
    }
}
