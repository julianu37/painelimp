<?php

namespace App\Http\Controllers;

// Importar o trait
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller
{
    // Usar o trait
    use AuthorizesRequests;
}
