<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckSecretario
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if (!$user->isSecretario()) {
            return redirect()->route('dashboard')->with('error', 'Acesso restrito para secretários.');
        }

        if (!$user->isAtivo()) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Sua conta está desativada.');
        }

        return $next($request);
    }
}
