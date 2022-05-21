<?php

namespace App\Http\Controllers;
use Illuminate\Auth\Events\Registered;
use App\Mail\{EmailVerification, OtpLink};
use Illuminate\Support\Facades\DB;
use App\Models\{User, Verify};
use App\Helpers\Sms;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Validator;
use Hash;
use Mail;
use Exception;


class SignupController extends Controller
{

    /**
     * Singup view Page
     * 
     * @return view
     */
    public function index()
    {
        return view('frontend.signup.index')->with(['title' => 'Signup | Best Property Market']);
    }

}
