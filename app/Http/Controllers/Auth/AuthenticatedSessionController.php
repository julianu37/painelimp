<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        if (request()->hasSession() && url()->previous() && !str_contains(url()->previous(), '/login') && !str_contains(url()->previous(), '/register') && !str_contains(url()->previous(), '/logout')) {
            session(['url.intended' => url()->previous()]);
        }
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Obter o usuário autenticado
        $user = $request->user();

        // Verificar se o usuário é administrador
        if ($user->isAdmin()) {
            // Redirecionar admin sempre para o dashboard admin
            return redirect()->route('admin.dashboard');
        }

        // Para outros usuários (técnicos), usar o redirecionamento pretendido
        return redirect()->intended(route('dashboard'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
