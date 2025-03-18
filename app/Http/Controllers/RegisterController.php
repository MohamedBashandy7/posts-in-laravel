<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RegisterController extends Controller {
    public function index() {
        $formFields = [
            [
                'id' => 'name',
                'label' => 'User Name',
                'type' => 'text',
                'name' => 'name',
                'help' => 'user_help',
                'helpText' => ""
            ],
            [
                'id' => 'email',
                'label' => 'Email',
                'type' => 'email',
                'name' => 'email',
                'help' => 'emailHelp',
                'helpText' => "We'll never share your email with anyone else."
            ],
            [
                'id' => 'exampleInputPassword1',
                'label' => 'Password',
                'type' => 'password',
                'name' => 'password',
                'help' => '',
                'helpText' => ''
            ],
            [
                'id' => 'exampleInputPassword1',
                'label' => 'Confirm Password',
                'type' => 'password',
                'name' => 'password_confirmation',
                'help' => '',
                'helpText' => ''
            ],
        ];
        $route = route('cteate new user');
        $submit_button = 'Register';
        return view('auth.register', ['formFields' => $formFields, 'route' => $route, 'submit_button' => $submit_button]);
    }


    public function create(Request $request) {
        $fields = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);
        $user = USER::create($fields);
        Auth::login($user);
        return redirect()->route('dashboard', ['name' => Auth::user()->name]);
    }
}
