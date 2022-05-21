<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Gate;

class Permissions {
    
    /**
     * Permission to a perticular resourse
     */
	public static function get($user, $resource) {
        $permissions = [];
        if ($user->permissions()->exists()) {
            foreach ($user->permissions as $access) {
                if ($resource === $access->resource) {
                    $permissions[] = $access->permission;
                }
            }
        }

        return $permissions;
    }

}