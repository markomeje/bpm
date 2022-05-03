<?php

namespace App\Http\Controllers\User;
use App\Models\Review;
use App\Http\Controllers\Controller;
use \Exception;
use Validator;


class ReviewsController extends Controller
{
	/**
     * User reviews list view
     */
    public function index()
    {
        return view('user.reviews.index')->with(['reviews' => Review::where(['user_id' => auth()->id()])->paginate(10)]);
    }

}