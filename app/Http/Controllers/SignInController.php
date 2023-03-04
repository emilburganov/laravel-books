<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignInController extends Controller
{
    public function index(): Factory|View|Application
    {
        return view('signin');
    }

    public function checkUser(Request $request): RedirectResponse
    {
        if(!Auth::attempt([
            'login' => $request->input('login'),
            'password' => $request->input('password'),
        ])) {
            return redirect()->back()->with('message', 'Invalid login or password.');
        }

        return redirect()->route('main');
    }

    public function logoutUser(): RedirectResponse
    {
        Auth::logout();

        return redirect()->route('signin');
    }
}
