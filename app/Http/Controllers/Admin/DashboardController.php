<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
// use App\Models\CodigoErro; // Removido
use App\Models\Manual;
use App\Models\Comentario;
use App\Models\Marca;
use App\Models\Modelo;

class DashboardController extends Controller
{
    /**
     * Exibe o dashboard administrativo.
     */
    public function index(): View
    {
        // Conta os registros relevantes
        $totalTecnicos = User::where('role', 'tecnico')->count();
        // $totalCodigos = CodigoErro::count(); // Removido
        $totalManuais = Manual::count();
        $totalComentarios = Comentario::count();
        $totalMarcas = Marca::count();
        $totalModelos = Modelo::count();

        // REMOVIDO: Busca os 5 últimos códigos de erro adicionados
        // $ultimosCodigos = CodigoErro::with('modelos:id,slug,nome')
        //                         ->orderBy('created_at', 'desc')
        //                         ->take(5)
        //                         ->get();

        // Busca os 5 últimos manuais adicionados
        $ultimosManuais = Manual::with('modelos:id,nome') // Carrega modelos associados
                                ->orderBy('created_at', 'desc')
                                ->take(5)
                                ->get();

        // Busca os 5 últimos comentários adicionados
        $ultimosComentarios = Comentario::with(['user:id,name', 'comentavel']) // Carrega usuário e item comentado
                                        ->orderBy('created_at', 'desc')
                                        ->take(5)
                                        ->get();

        // Passa os dados para a view
        return view('admin.dashboard', compact(
            'totalTecnicos',
            // 'totalCodigos', // Removido
            'totalManuais',
            'totalComentarios',
            'totalMarcas',
            'totalModelos',
            // 'ultimosCodigos', // Removido
            'ultimosManuais',
            'ultimosComentarios'
        ));
    }
}
