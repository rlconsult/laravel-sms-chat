<?php

namespace Filament\Policies;

use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine if the authenticated user view users.
     *
     * @param  User  $authenticated
     * @param  User  $user
     * @return bool
     */
    public function view($authenticated): Response
    {
        return $authenticated->can('view users')
                ? Response::allow()
                : Response::deny(__('You are not allowed to view users.'));
    }

    /**
     * Determine if the authenticated user can update a user.
     *
     * @param  User  $authenticated
     * @param  User  $user
     * @return bool
     */
    public function edit($authenticated, $user): Response
    {
        if ($authenticated->can('edit users')) {
            return Response::allow();
        }

        return $authenticated->id === $user->id
                ? Response::allow()
                : Response::deny(__('You are not allowed to edit other users.'));
    }
}