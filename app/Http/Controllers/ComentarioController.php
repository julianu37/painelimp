<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\CodigoErro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class ComentarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validação dos dados do formulário
        $validated = $request->validate([
            'codigo_erro_id' => 'required|exists:codigos_erro,id',
            'comentario' => 'required|string|min:5',
        ]);

        // Cria o comentário associando ao usuário logado
        try {
            Comentario::create([
                'user_id' => Auth::id(),
                'codigo_erro_id' => $validated['codigo_erro_id'],
                'comentario' => $validated['comentario'],
            ]);

            // Busca o slug do código de erro para redirecionar corretamente
            $codigoErro = CodigoErro::findOrFail($validated['codigo_erro_id']);

            // Redireciona de volta para a página do código de erro com sucesso
            return redirect()->route('codigos.show', $codigoErro)->with('success', 'Comentário adicionado com sucesso!');

        } catch (\Exception $e) {
            // Em caso de erro, redireciona de volta com mensagem de erro
            // Logar o erro $e->getMessage() seria bom em produção
            return back()->with('error', 'Erro ao salvar o comentário. Tente novamente.')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Comentario $comentario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comentario $comentario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comentario $comentario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comentario $comentario)
    {
        // Este método será implementado em Admin\ComentarioController
    }
}
