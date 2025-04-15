<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\CodigoErro;
use App\Models\Manual;
use App\Models\Comentario;
use Illuminate\Support\Facades\Auth; // Importar Auth

class TecnicoDashboardController extends Controller
{
    /**
     * Exibe o dashboard para usuários técnicos.
     */
    public function index(): View
    {
        // Busca os 5 últimos códigos de erro públicos
        $ultimosCodigos = CodigoErro::where('publico', true)
                           ->orderBy('created_at', 'desc')
                           ->take(5)
                           ->get();

        // Busca os 5 últimos manuais adicionados (carregando modelo e marca)
        $ultimosManuais = Manual::with(['modelo:id,nome,marca_id', 'modelo.marca:id,nome'])
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();

        // Busca os 5 últimos comentários (com usuário e item comentado)
        $ultimosComentarios = Comentario::with(['user:id,name', 'comentavel'])
                                ->orderBy('created_at', 'desc')
                                ->take(5)
                                ->get();

        // Opcional: Busca os 5 últimos comentários do usuário logado
        // $meusUltimosComentarios = Comentario::where('user_id', Auth::id())
        //                         ->with('comentavel')
        //                         ->orderBy('created_at', 'desc')
        //                         ->take(5)
        //                         ->get();

        return view('dashboard', compact(
            'ultimosCodigos',
            'ultimosManuais',
            'ultimosComentarios'
            // 'meusUltimosComentarios' // Descomentar se for usar
        ));
    }
} 