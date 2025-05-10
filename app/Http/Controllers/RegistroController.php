<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use App\Models\User;
use Illuminate\Http\Request;

class RegistroController extends Controller
{
    public function getRegister()
    {
        return response()->json(Registro::whereHas('user', function ($query) {
            $query->where('email', 'admin@gmail.com');
        })->latest()->first());
    }

    public function getRegisterNotUserPermission()
    {
        return response()->json(Registro::whereHas('user', function ($query) {
            $query->where('email', 'clay@gmail.com');
        })->latest()->first());
    }

    /**
     * Listar todos os registros.
     */
    public function index()
    {
        $registros = Registro::with('user')
            ->whereDoesntHave('user', function ($query) {
                $query->where('email', 'clay@gmail.com');
            })
            ->latest()
            ->get();


        $activeCount = $registros->whereNotNull('ENTRADA')->whereNull('SAIDA')->count();
        $closedCount = $registros->whereNotNull('ENTRADA')->whereNotNull('SAIDA')->count();


        return view('pages.registros.index', compact('registros', 'activeCount', 'closedCount'));
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
    public function destroy($registroId)
    {
        // Encontra o registro pelo ID
        $registro = Registro::find($registroId);

        if ($registro) {
            // Deleta o registro
            $registro->delete();

            // Retorna uma resposta de sucesso
            return response()->json(['message' => 'Registro removido com sucesso.'], 200);
        }

        // Caso o registro não seja encontrado
        return response()->json(['message' => 'Registro não encontrado.'], 404);
    }
}
