<?php

namespace App\Http\Controllers\Admin\Charts;
use App\Models\Property;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

/**
 * For rendering properties chart data
 */
class PropertiesController extends Controller
{
    /**
     * Admin Properties charts data
     */
    public function chart($year = 0)
    {
        $year = empty($year) ? date('Y') : $year;
        $properties = Property::whereYear('created_at', '=', $year)->get();
        $groupedByMonth = $properties->groupBy(function($data) {
              return Carbon::parse($data->created_at)->format('m');
        })->sort()->toArray();

        $data = [];
        foreach ($groupedByMonth as $month => $value) {
            $month = (int)$month;
            $data[$month] = count($value);
        }

        $result =  array_replace(array_fill_keys(range(1, 12), 0), $data);
        ksort($result);
        return response()->json([
            'data' => array_values($result),
            'months' => array_values(months()),
            'status' => 1,
        ]);
    }

}
