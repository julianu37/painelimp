<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use App\Models\CodigoErro;
use App\Models\Manual;
use App\Models\Comentario;

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

        // Retorna a view do dashboard admin (precisará ser criada)
        return view('admin.dashboard', compact(
            'totalTecnicos',
            'totalCodigos',
            'totalManuais',
            'totalComentarios'
        ));
    }
}
