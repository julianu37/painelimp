<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use App\Models\CodigoErro;
use App\Models\Manual;
use App\Models\Comentario;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Solucao;

class DashboardController extends Controller
{
    /**
     * Exibe o dashboard administrativo com algumas estatísticas.
     */
    public function index(): View
    {
        // Conta os registros relevantes
        $totalTecnicos = User::where('role', 'tecnico')->count();
        $totalCodigos = CodigoErro::count();
        $totalManuais = Manual::count();
        $totalComentarios = Comentario::count();
        $totalMarcas = Marca::count();
        $totalModelos = Modelo::count();
        $totalSolucoes = Solucao::count();

        // Busca os 5 últimos códigos de erro adicionados
        $ultimosCodigos = CodigoErro::orderBy('created_at', 'desc')->take(5)->get();

        // Busca os 5 últimos comentários adicionados (com usuário e item comentado)
        $ultimosComentarios = Comentario::with(['user:id,name', 'comentavel'])
                                ->orderBy('created_at', 'desc')
                                ->take(5)
                                ->get();

        // Retorna a view do dashboard admin
        return view('admin.dashboard', compact(
            'totalTecnicos',
            'totalCodigos',
            'totalManuais',
            'totalComentarios',
            'totalMarcas',
            'totalModelos',
            'totalSolucoes',
            'ultimosCodigos',
            'ultimosComentarios'
        ));
    }
}
