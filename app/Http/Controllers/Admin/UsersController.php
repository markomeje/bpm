<?php

namespace App\Http\Controllers\Admin;
use App\Models\{User};
use App\Http\Controllers\Controller;
use Validator;

class UsersController extends Controller
{
    /**
     * Admin users list view
     */
    public function index()
    {
        $query = request()->get('query');
        $users = empty($query) ? User::paginate(32) : User::search(['name', 'email', 'profile.designation', 'profile.role', 'profile.type', 'profile.description', 'profile.address'], $query)->paginate(24);
        return view('admin.users.index')->with(['users' => $users, 'roles' => User::distinct()->pluck('role')]);
    }

    /**
     * User profile
     */
    public function profile($id = 0)
    {
        return view('admin.users.profile')->with(['user' => User::find($id)]);
    }

    /**
     * Search Users
     */
    public function search()
    {
        $query = request()->get('query');
        return view('admin.users.search')->with(['users' => User::search(['name', 'email', 'profile.designation', 'profile.role'], $query)->paginate(24), 'query' => $query]);
    }

}
