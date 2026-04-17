<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsNotBanned
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && \App\Models\User::find($user->id)->is_banned) {
            Auth::logout();

            if ($request->expectsJson()) {
                return response()->json(['message' => 'Your account has been banned.'], 403);
            }

            return redirect('/')->with('error', 'Your account has been banned.');
        }

        return $next($request);
    }
}
