<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)  // изменено имя метода
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('products')
                ->withSuccess('Signed in');
        }

        return redirect("login")->withError('Login details are not valid');
    }

    public function registration()
    {
        return view('auth.register');
    }

    public function register(RegistrationRequest $request)  // изменено имя метода
    {
        $data = $request->validated();
        $this->create($data);

        return redirect("login")->withSuccess('You have signed-in');
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return redirect('login');
    }
}
