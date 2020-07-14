<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PaymentAccount;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PaymentAccountPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->is_verified_partner 
            ? Response::allow() 
            : Response::deny('only partner organizers can add payment accounts');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\PaymentAccount  $paymentAccount
     * @return mixed
     */
    public function update(User $user, PaymentAccount $paymentAccount)
    {
        return $user->id === $paymentAccount->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\PaymentAccount  $paymentAccount
     * @return mixed
     */
    public function delete(User $user, PaymentAccount $paymentAccount)
    {
        return $user->id === $paymentAccount->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\PaymentAccount  $paymentAccount
     * @return mixed
     */
    public function restore(User $user, PaymentAccount $paymentAccount)
    {
        return $user->id === $paymentAccount->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\PaymentAccount  $paymentAccount
     * @return mixed
     */
    public function forceDelete(User $user, PaymentAccount $paymentAccount)
    {
        return $user->id === $paymentAccount->user_id;
    }
}
