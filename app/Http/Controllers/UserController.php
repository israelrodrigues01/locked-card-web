<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Mostrar todos os usuários.
     */
    public function index()
    {
        $usuarios = User::latest()->get();
        return view('pages.usuarios.index', compact('usuarios'));
    }

    /**
     * Mostrar o formulário para criar um novo usuário.
     */
    public function create()
    {
        return view('pages.usuarios.create');
    }

    /**
     * Armazenar um novo usuário.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
        ]);

        User::create([
            'CODE' => $request->CODE,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuário criado com sucesso.');
    }

    /**
     * Mostrar o usuário específico.
     */
    public function show(User $user)
    {
        return view('pages.usuarios.show', compact('user'));
    }

    /**
     * Mostrar o formulário para editar o usuário.
     */
    public function edit(User $user)
    {
        return view('pages.usuarios.edit', compact('user'));
    }

    /**
     * Atualizar o usuário.
     */
    public function update(Request $request, string $cod)
    {
        $user = User::find($cod);

        if (!$user) {
            return redirect()->route('usuarios.index')->with('error', 'Usuário não encontrado.');
        }

        $user->update([
            'name' => $request->name,
            'CODE' => $request->CODE,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuário atualizado com sucesso.');
    }

    /**
     * Remover o usuário.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuário removido com sucesso.');
    }
}
