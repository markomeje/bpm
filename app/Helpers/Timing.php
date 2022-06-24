<?php

namespace App\Helpers;
use Illuminate\Support\Str;
use \Exception;
use \Carbon\Carbon;

/**
 * Calculate timing durations,
 * expiry, days etc
 */
class Timing
{
	/**
	 * Expiry status
	 * 
	 * @type bool
	 */
	public $expired = false;

	/**
	 * Expiry date
	 * 
	 * @type date format
	 */
	public $expiry = null;

	/**
	 * Timing duration (e.g., 200days)
	 * 
	 * @type int
	 */
	public $duration = 0;

	/**
	 * paused status
	 * 
	 * @type bool
	 */
	public $paused = false;


	/**
	 */
	public function __construct(int $duration = 0, int $progress = 0, bool $expired = false, int $daysleft = 0, bool $paused = false)
	{
		$this->duration = $duration;
		$this->progress = $progress;
		$this->expired = $expired;
		$this->daysleft = $daysleft;
		$this->paused = $paused;
	}

	/**
	 * Calculate durations
	 */
	public static function calculate(?int $duration = 0, ?string $expiry = '', ?string $started = '', $paused = '') : self
	{
		$started = Carbon::parse($started);
		$duration = (int)$started->diffInDays($expiry); // overridding original credit duration passed

		$daysleft = ($duration - $started->diffInDays(Carbon::now()));
		$daysleft = (empty($daysleft) || $daysleft <= 0) ? 0 : $daysleft;
		$daysleft = empty($paused) ? $daysleft : ($duration - $started->diffInDays($paused));

		$fraction = $duration >= $daysleft ? ($daysleft/($duration ?: 1)) : 0;
		$progress = (int)round(100 - ($fraction * 100));
		$expired = empty($expiry) ? false : ($progress === 100 ? true : false);
		return new Timing($duration, $progress, $expired, $daysleft, !empty($paused));
	}

	/**
	 * Expired status
	 */
	public function expired() : bool
	{
		return $this->expired;
	}

	/**
	 * Remaining days
	 * 
	 * @return integer
	 */
	public function daysleft() : int
	{
		return $this->daysleft;
	}

	/**
	 * Timing progress (e.g., 10%)
	 * 
	 * @return integer
	 */
	public function progress() : int
	{
		return $this->progress;
	}

	/**
	 * Paused status
	 */
	public function paused() : bool
	{
		return $this->paused;
	}

	/**
	 * Timing duration
	 */
	public function duration() : int
	{
		return $this->duration;
	}
}