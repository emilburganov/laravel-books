<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminCheck
{
    public function handle(Request $request, Closure $next)
    {
        if (User::query()->find(Auth::id())->role->name === 'Админ') {
            return $next($request);
        }

        return redirect()->route('signin');
    }
}
