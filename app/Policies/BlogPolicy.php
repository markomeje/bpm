<?php

namespace App\Policies;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Blog $blog)
    {
        $permissions = $user->permissions->where(['resource' => 'post'])->pluck('permission')->toArray();
        return in_array('update', $permissions) || in_array($user->role, ['superadmin']);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Blog $blog)
    {
        $permissions = $user->permissions->where(['resource' => 'post'])->pluck('permission')->toArray();
        return in_array('delete', $permissions) || in_array($user->role, ['superadmin']);
    }

}
