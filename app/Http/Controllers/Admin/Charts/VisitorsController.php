<?php

namespace App\Http\Controllers\Admin\Charts;
use App\Models\Visitor;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

/**
 * For rendering properties chart data
 */
class VisitorsController extends Controller
{
    /**
     * Admin Properties charts data
     */
    public function chart()
    {
        $groupedByTimezone = collect(Visitor::all())->groupBy(function($data) {
              return explode('/', $data->timezone)[0] ?? 'utc';
        })->sort()->toArray();

        $data = $timezones = [];
        foreach ($groupedByTimezone as $timezone => $value) {
            $data[$timezone] = count($value);
            $timezones[] = $timezone;
        }

        return response()->json([
            'data' => array_values($data),
            'labels' => array_values($timezones),
            'status' => 1,
        ]);
    }

}
