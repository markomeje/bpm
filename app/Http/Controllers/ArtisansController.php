<?php

namespace App\Http\Controllers;
use App\Models\{Profile, Review};
use Illuminate\Http\Request;

class ArtisansController extends Controller
{
    /**
     * Artisans home page
     */
    public function index()
    {
        return view('frontend.artisans.index')->with(['artisans' => Profile::where(['role' => 'artisan'])->paginate(24)]);
    }

    /**
     * Artisan profile page
     */
    public function profile($id, $name = '')
    {
        return view('frontend.artisans.profile')->with(['profile' => Profile::findOrFail($id)]);
    }
}
