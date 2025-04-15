<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Exibe a página inicial.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        // Por enquanto, apenas retorna a view 'welcome'
        // TODO: Personalizar a home page (ex: buscar últimos códigos públicos)
        return view('welcome');
    }
}
