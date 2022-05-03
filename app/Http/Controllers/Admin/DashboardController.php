<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Helpers\Eloquent;
use App\Models\{Property};
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class DashboardController extends Controller
{
    
    public function index()
    {
        $years = collect(Property::all())->unique(function($item){
            return Carbon::parse($item['created_at'])->format('Y');;
        })->map(function($item){
            return Carbon::parse($item['created_at'])->format('Y');;
        })->sort()->toArray();

        return view('admin.dashboard.index')->with(['years' => $years]);
    }
}
