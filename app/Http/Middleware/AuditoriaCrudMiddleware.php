<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AuditoriaCrudMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()) {
            return redirect()->route('login')
                ->with('error', 'Faça login para gerenciar os dados do IAFit.');
        }

        Log::info('[IAFit CRUD] Acesso autorizado', [
            'usuario' => $request->user()->email,
            'metodo' => $request->method(),
            'rota' => $request->path(),
            'ip' => $request->ip(),
        ]);

        return $next($request);
    }
}