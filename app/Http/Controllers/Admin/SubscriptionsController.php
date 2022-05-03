<?php

namespace App\Http\Controllers\Admin;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscriptionsController extends Controller
{
    /**
     * Admin countries page view
     */
    public function index($status = '')
    {
        $subscriptions = empty($status) ? Subscription::latest()->paginate(24) : Subscription::where(['status' => strtolower($status)])->latest()->paginate(18);
        return view('admin.subscriptions.index')->with(['subscriptions' => $subscriptions]);
    }

}
