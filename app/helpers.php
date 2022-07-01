<?php 

use App\Models\Property;

if (!function_exists('retitle')) {
    function retitle($property) {
        if (empty($property)) throw new Exception('Invalid property passed for title generation');

        $categories = Property::$categories;
        $category = isset($categories[$property->category]) ? $categories[$property->category] : '';
        $group = $property->group;
        $address = $property->address ? ucwords($property->address) : $property->address;

        $action = strtolower($property->action);
        $actions = Property::$actions;
        $action = isset($actions[$action]) ? $actions[$action] : '';
        switch ($property->category) {
            case 'land':
                $title = (empty($group) ? ($category['name'] ?? '') : $group) .' '. $action.' Located at '. $address;
                break;
            case 'residential':
                $title = (empty($property->bedrooms) ? '' : $property->bedrooms.' Bedroom').' '.(empty($group) ? ($category['name'] ?? '') : $group).' '.$action.' Located at '.$address;
                break;
            case 'commercial':
                $title = (empty($group) ? ($category['name'] ?? '') : $group).' '.$action.' Located at '.$address;
                break;
            default:
                $title = ucfirst(($category['name'] ?? '')).' '. $action.' Located at '. $address;
                break;
        }

        return $title;
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

