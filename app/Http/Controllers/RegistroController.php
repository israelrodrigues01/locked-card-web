<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use App\Models\User;
use Illuminate\Http\Request;

class RegistroController extends Controller
{
    /**
     * Listar todos os registros.
     */
    public function index()
    {
        $registros = Registro::with('user')->latest()->get();
        return view('pages.registros.index', compact('registros'));
    }

    /**
     * Mostrar formulário de criação.
     */
    public function create()
    {
        $usuarios = User::all();
        return view('pages.registros.create', compact('usuarios'));
    }

    /**
     * Armazenar novo registro.
     */
    public function store(Request $request)
    {
        $request->validate([
            'CODUSU' => 'required|exists:users,CODUSU',
            'ENTRADA' => 'nullable|date',
            'SAIDA' => 'nullable|date|after_or_equal:ENTRADA',
        ]);

        Registro::create($request->only('CODUSU', 'ENTRADA', 'SAIDA'));

        return redirect()->route('registros.index')->with('success', 'Registro criado com sucesso.');
    }

    /**
     * Mostrar registro individual.
     */
    public function show(Registro $registro)
    {
        $registro->load('user');
        return view('pages.registros.show', compact('registro'));
    }

    /**
     * Mostrar formulário de edição.
     */
    public function edit(Registro $registro)
    {
        $usuarios = User::all();
        return view('pages.registros.edit', compact('registro', 'usuarios'));
    }

    /**
     * Atualizar registro.
     */
    public function update(Request $request, Registro $registro)
    {
        $request->validate([
            'CODUSU' => 'required|exists:users,CODUSU',
            'ENTRADA' => 'nullable|date',
            'SAIDA' => 'nullable|date|after_or_equal:ENTRADA',
        ]);

        $registro->update($request->only('CODUSU', 'ENTRADA', 'SAIDA'));

        return redirect()->route('registros.index')->with('success', 'Registro atualizado com sucesso.');
    }

    /**
     * Remover registro.
     */
    public function destroy(Registro $registro)
    {
        $registro->delete();
        return redirect()->route('registros.index')->with('success', 'Registro removido com sucesso.');
    }
}
