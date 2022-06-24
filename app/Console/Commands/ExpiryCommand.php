<?php

namespace App\Console\Commands;
use App\Models\{Advert, Credit, Promotion};
use App\Helpers\Timing;
use Illuminate\Console\Command;

class ExpiryCommand extends Command
{
    /**
     * The name and signature of the console command.
     * 86400seconds = 1day
     *
     * @var string
     */
    protected $signature = 'expiry:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check credits, promotions and adverts expiry every day.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (app()->environment(['production'])) {
            $this->info('Calling expiry check for credits, promotions and adverts.');

            $credits = Credit::all();
            if ($credits->count() > 0) {
                foreach ($credits as $credit) {
                    $timing = Timing::calculate($credit->duration, $credit->expiry, $credit->started);
                    if ($timing->expired() && $credit->status !== 'expired') {
                        $credit->status = 'expired';
                        $credit->update();
                    }
                }
            }

            $adverts = Advert::all();
            if ($adverts->count() > 0) {
                foreach ($adverts as $advert) {
                    $timing = Timing::calculate($advert->duration, $advert->expiry, $advert->started);
                    if ($timing->expired() && $advert->status !== 'expired') {
                        $advert->status = 'expired';
                        $advert->update();
                    }
                }
            }

            $promotions = Promotion::all();
            if ($promotions->count() > 0) {
                foreach ($promotions as $promotion) {
                    $timing = Timing::calculate($promotion->duration, $promotion->expiry, $promotion->started);
                    if ($timing->expired() && $promotion->status !== 'expired') {
                        $promotion->status = 'expired';
                        $promotion->update();
                    }
                }
            }
        }
    }
}
