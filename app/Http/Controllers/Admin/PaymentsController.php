<?php

namespace App\Http\Controllers\Admin;
use App\Models\Payment;
use App\Http\Controllers\Controller;
use Validator;

class PaymentsController extends Controller
{
    /**
     * Admin payments list view
     */
    public function index($type = '')
    {
        $payments = empty($type) ? Payment::paginate(32) : Payment::where(['type' => $type])->latest()->paginate(24);
        return view('admin.payments.index')->with(['payments' => $payments, 'type' => $type]);
    }

    /**
     * Search Users
     */
    public function search()
    {
        $query = request()->get('query');
        $payments = Payment::search(['amount', 'type', 'currency.symbol', 'user.name'], $query)->paginate(24);
        return view('admin.payments.search')->with(['payments' => $payments, 'query' => $query]);
    }

}