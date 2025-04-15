<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTecnicoRequest;
use App\Http\Requests\Admin\UpdateTecnicoRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class TecnicoController extends Controller
{
    /**
     * Exibe uma lista dos técnicos.
     */
    public function index(): View
    {
        $tecnicos = User::where('role', 'tecnico')->orderBy('name')->paginate(15);
        return view('admin.tecnicos.index', compact('tecnicos'));
    }

    /**
     * Mostra o formulário para criar um novo técnico.
     */
    public function create(): View
    {
        return view('admin.tecnicos.create');
    }

    /**
     * Salva um novo técnico no banco de dados.
     */
    public function store(StoreTecnicoRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        try {
            User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'tecnico',
            ]);

            return redirect()->route('admin.tecnicos.index')->with('success', 'Técnico criado com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao criar técnico: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Mostra os detalhes de um técnico (opcional no admin).
     */
    public function show(User $tecnico): View
    {
        if ($tecnico->role !== 'tecnico') {
            abort(404);
        }
        return view('admin.tecnicos.show', compact('tecnico'));
    }

    /**
     * Mostra o formulário para editar um técnico existente.
     */
    public function edit(User $tecnico): View|RedirectResponse
    {
        if ($tecnico->role !== 'tecnico') {
            return redirect()->route('admin.tecnicos.index')->with('error', 'Usuário inválido para edição.');
        }
        return view('admin.tecnicos.edit', compact('tecnico'));
    }

    /**
     * Atualiza um técnico existente no banco de dados.
     */
    public function update(UpdateTecnicoRequest $request, User $tecnico): RedirectResponse
    {
        if ($tecnico->role !== 'tecnico') {
            return redirect()->route('admin.tecnicos.index')->with('error', 'Usuário inválido para atualização.');
        }

        $validated = $request->validated();

        try {
            $dataToUpdate = [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'role' => 'tecnico',
            ];

            if (!empty($validated['password'])) {
                $dataToUpdate['password'] = Hash::make($validated['password']);
            }

            $tecnico->update($dataToUpdate);

            return redirect()->route('admin.tecnicos.index')->with('success', 'Técnico atualizado com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao atualizar técnico: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove um técnico do banco de dados.
     */
    public function destroy(User $tecnico): RedirectResponse
    {
        if ($tecnico->role !== 'tecnico' || $tecnico->id === auth()->id()) {
            return redirect()->route('admin.tecnicos.index')->with('error', 'Não é possível excluir este usuário.');
        }

        try {
            $tecnico->delete();
            return redirect()->route('admin.tecnicos.index')->with('success', 'Técnico excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('admin.tecnicos.index')->with('error', 'Erro ao excluir técnico: ' . $e->getMessage());
        }
    }
}
