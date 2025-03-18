<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {
    public function index() {
        $formFields = [
            [
                'id' => 'exampleInputEmail1',
                'label' => 'Email address',
                'type' => 'email',
                'name' => 'email',
                'help' => 'emailHelp',
                'helpText' => ""
            ],
            [
                'id' => 'exampleInputPassword1',
                'label' => 'Password',
                'type' => 'password',
                'name' => 'password',
                'help' => '',
                'helpText' => ''
            ],
        ];
        $route = route('login.store');
        $submit_button = 'Login';
        return view('auth.login', ['formFields' => $formFields, 'route' => $route, 'submit_button' => $submit_button]);
    }

    public function login(Request $request) {
        $fields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($fields, $request->remember)) {
            return redirect()->intended(route('dashboard'));
        } else {
            return back()->withErrors(['error' => 'Wrong credentials']);
        }
    }
}
