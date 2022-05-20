<?php

namespace App\Policies;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user)
    {
        $permissions = $user->permissions->where(['resource' => 'payments'])->pluck('permission')->toArray();
        return in_array('update', $permissions) || in_array($user->role, ['superadmin']);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user)
    {
        $permissions = $user->permissions->where(['resource' => 'payments'])->pluck('permission')->toArray();
        return in_array('delete', $permissions) || in_array($user->role, ['superadmin']);
    }

}
