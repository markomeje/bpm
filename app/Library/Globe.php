<?php

namespace App\Library;
use Illuminate\Support\Facades\Http;
use \Exception;
use MenaraSolutions\Geographer\Earth;
use MenaraSolutions\Geographer\Country;


class Globe
{

    /**
     * @var object
     */
    public $earth;

    /**
     * @var object
     */
    public $countries;

    /**
     * @var object
     * IS02 CODE
     */
    public $code;

    /**
     * Call Earth Api 
     */
    public function __construct($earth, array $countries, $code = 'NG') 
    {
        $this->earth = $earth;
        $this->countries = $countries;
        $this->code = $code;
    }

	/**
	 * Query Earth api
	 */
	public static function get($code)
	{
        $earth = (new Earth);
        $countries = $earth->getCountries();
        return (new Globe($earth, $countries->toArray(), $code));
	}

    /**
     * List of all countries
     */
    public function countries()
    {
        return $this->countries;
    }

    /**
     * A country
     */
    public function country()
    {
        return Country::build($this->code);
    }

    /**
     * A country currency code
     */
    public function currency()
    {
        $this->country()->getCurrencyCode();
    }

    /**
     * A list of states in a country
     */
    public function states()
    {
        return $this->country()->getStates()->toArray();
    }

}