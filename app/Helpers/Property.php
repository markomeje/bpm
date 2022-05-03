<?php

namespace App\Helpers;
use App\Models\Property;
use \Exception;


/**
 * Helpers for the app
 */
class Property
{
	/**
	 * Generate title for respective properties
	 * Based on category
	 */
	public function title(object $property)
	{
		if (empty($property)) {
			throw new Exception('Invalid property passed for title generation');
		}

		$category = $property->category->name ?? '';
	    $status = $property->status ? ucwords($property->status) : '';
	    $bedrooms = $property->bedrooms ?? '';
	    $condition = $property->condition ?? '';
	    switch ($category) {
	        case 'lands':
	            return 'Landed Property '. $status.' Located at '. $property->address ?? '';
	            break;
	        case 'residential':
	            return $condition.' '.$bedrooms.' bedroom '.($property->house->name ?? '').' '.$status.' Located at '.$property->address ?? '';
	            break;
	        case 'commercial':
	            return $condition.' '.($property->house->name ?? '').' '.$status.' Located at '.$property->address ?? '';
	            break;
	        default:
	            return ucfirst($category).' Building '. $status.' Located at '. $property->address ?? '';
	            break;
	    }
	}

}