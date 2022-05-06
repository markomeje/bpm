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
