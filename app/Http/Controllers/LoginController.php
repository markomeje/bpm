<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use Validator;

class LoginController extends Controller
{

    /**
     * Login View
     * 
     * @return void
     */
    public function index()
    {
        return view('frontend.login.index')->with(['title' => 'Login | Best Property Market']);
    }

    /**
     * Ajax Login
     * 
     */
    public function auth()
    {
        $data = request()->only(['login', 'password']);
        $validator = Validator::make($data, [
            'login' => ['required'], 
            'password' => ['required']
        ], ['login.required' => 'Enter your email or phone number.']);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        $user = User::where(['email' => $data['login']])->first() || User::where(['phone' => $data['login']])->first();
        if (empty($user)) {
            return response()->json([
                'status' => 0,
                'info' => 'Invalid login details.'
            ]);
        }

        if (auth()->attempt(['email' => $data['login'], 'password' => $data['password']]) || auth()->attempt(['phone' => $data['login'], 'password' => $data['password']])) {
            request()->session()->regenerate();

            return response()->json([
                'status' => 1,
                'info' => 'Operation successful.', 
                'redirect' => route('dashboard'),
            ]);
        }

        return response()->json([
            'status' => 0,
            'info' => 'Invalid login details'
        ]);
    }

    public function logout()
    {
        auth()->logout();
        request()->session()->flush();
        request()->session()->invalidate();

        foreach(request()->cookie() as $name => $value) {
            Cookie::queue(Cookie::forget($name));
        }

        $redirect = request()->query('redirect');
        return Route::has($redirect) ? redirect()->route($redirect) : redirect()->route('login');
    }

}
