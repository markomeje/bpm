<?php


namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use Stevebauman\Location\Facades\Location;
use App\Models\{Advert, Credit, Promotion};
use App\Helpers\Timing;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * API Request timeout
     * 180 seconds or 3Minutes
     */
    public static $timeout = 180;

    public function __construct()
    {
        Request::macro('subdomain', function () {
            $subdomain = current(explode('.', $this->getHost()));
            if (env('APP_ENV') == 'review') {
                switch ($subdomain) {
                    case 'reviewuser':
                        $subdomain = 'user';
                        break;
                    case 'reviewadmin':
                        $subdomain = 'admin';
                        break;
                    case 'reviewapi':
                        $subdomain = 'api';
                        break;
                    default:
                        $subdomain = 'review';
                        break;
                }
            }

            return $subdomain;
        });

        $credits = Credit::all();
        if ($credits->count() > 0) {
            foreach ($credits as $credit) {
                $timing = Timing::calculate($credit->duration ?? 0, $credit->expiry, $credit->started);
                if ($timing->expired() && $credit->status !== 'expired') {
                    $credit->status = 'expired';
                    $credit->update();
                }
            }
        }

        $adverts = Advert::all();
        if ($adverts->count() > 0) {
            foreach ($adverts as $advert) {
                $timing = Timing::calculate($advert->duration ?? 0, $advert->expiry, $advert->started);
                if ($timing->expired() && $advert->status !== 'expired') {
                    $advert->status = 'expired';
                    $advert->update();
                }
            }
        }

        $promotions = Promotion::all();
        if ($promotions->count() > 0) {
            foreach ($promotions as $promotion) {
                $timing = Timing::calculate($promotion->duration ?? 0, $promotion->expiry, $promotion->started);
                if ($timing->expired() && $promotion->status !== 'expired') {
                    $promotion->status = 'expired';
                    $promotion->update();
                }
            }
        }
    }
    
}