<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SignUpController extends Controller
{
    public function index(): Factory|View|Application
    {
        return view('signup');
    }

    public function createUser(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required|alpha:ascii',
            'password' => ['required',
                'min:6',
                function ($attribute, $value, $fail): void {
                    if (preg_match_all('/\W[A-Za-z]|\W/u', $value) === 0) {
                        $fail('The ' . $attribute . ' must contain special characters and letters only.');
                    }
                }],
            'repeat_password' => 'same:password',
        ]);

        if ($validator->stopOnFirstFailure()->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        User::query()->create([
            'login' => $request->input('login'),
            'password' => Hash::make($request->input('password')),
        ]);

        Auth::attempt([
            'login' => $request->input('login'),
            'password' => $request->input('password'),
        ]);

        return redirect()->route('main');
    }
}
