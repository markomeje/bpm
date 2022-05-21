<?php

namespace App\Http\Controllers;
use App\Mail\ContactRequest;
use \Exception;
use Validator;
use Mail;

class ContactController extends Controller
{
    /**
     * Conatct page view
     */
    public function index()
    {
        return view('frontend.contact.index');
    }

    /**
     * Send contact message
     */
    public function send()
    {
        $data = request()->all();
        $validator = Validator::make($data, [
            'fullname' => ['required', 'string'],
            'designation' => ['required'],
            'phone' => ['required'],
            'email' => ['required', 'email'],
            'message' => ['required'],
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        try {
            Mail::to(env('CONTACT_EMAIL'))->send(new ContactRequest($data));
            return response()->json([
                'status' => 1,
                'info' => 'Thank you for contacting us. We would get back to you shortly.',
                'redirect' => route('contact', ['success' => 'true']),
            ]);

        } catch (Exception $error) {
            return response()->json([
                'status' => 0,
                'info' => 'Network Error. Try Again.'
            ]);
        }
    }

}
