<?php

namespace App\Http\Controllers;
use App\Models\{Profile, Review};
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProfilesController extends Controller
{

    /**
     * Profile page
     */
    public function profile($id, $name = '')
    {
        $title = Str::title(str_replace('-', ' ', $name)). ' Profile | Best Property Market';
        return view('frontend.profiles.profile')->with(['title' => $title, 'profile' => Profile::find($id)]);
    }
}
