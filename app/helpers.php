<?php 

use App\Models\Property;

if (!function_exists('retitle')) {
    function retitle($property) {
        if (empty($property)) {
            throw new \Exception('Invalid property passed for title generation');
        }

        $category = Property::$categories[$property->category];
        $action = $property->action ? Property::$actions[$property->action] : '';
        switch ($property->category) {
            case 'land':
                return (empty($property->group) ? $category['name'] : $property->group.' land') .' '. $action.' located at '. $property->address ?? '';
                break;
            case 'residential':
                return (empty($property->bedrooms) ? '' : $property->bedrooms.' Bedroom').' '.(empty($property->group) ? $category['name'] : $property->group).' '.$action.' located at '.$property->address ?? '';
                break;
            case 'commercial':
                return (empty($property->group) ? $category['name'] : $property->group).' '.$action.' located at '.$property->address ?? '';
                break;
            default:
                return ucfirst($category['name']).' '. $action.' located at '. $property->address ?? '';
                break;
        }
    }
}

if (!function_exists('firstname')) {
    function firstname($fullname = '') {
        return empty($fullname) ? '' : (explode(' ', $fullname)[0] ?? '');
    }
}

if (!function_exists('randomhex')) {
    function randomhex() {
        $code = substr(md5(rand()), 0, 6);
        return '#'.$code;
    }
}

if (!function_exists('randomrgba')) {
    function randomrgba($opacity = 0.5) {
        return 'rgba('.rand(0, 255).','. rand(0, 255).','. rand(0, 255).','. $opacity.')';
    }
}

if (!function_exists('months')) {
    function months() {
        return [
            'January', 
            'February', 
            'March', 
            'April', 
            'May', 
            'June', 
            'July', 
            'August', 
            'September', 
            'October', 
            'November', 
            'December'
        ];
    }
}

