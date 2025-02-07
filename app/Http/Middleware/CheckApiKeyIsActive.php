<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Auth\TokenGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckApiKeyIsActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** @var TokenGuard $auth */
        $auth = Auth::guard('api');

        /** @var User $user */
        $user = $auth->user();

        if (
            $auth->check() 
            && ! $user->is_active
        ) return response()->json([
            'message' => 'API key is unactive.'
        ], 403);

        return $next($request);
    }
}
