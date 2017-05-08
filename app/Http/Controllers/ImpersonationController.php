<?php

namespace App\Http\Controllers;

use App\User;

class ImpersonationController extends Controller
{
    /**
     * Impersonate the given user.
     *
     * @param  User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(User $user)
    {
        auth()->login($user);

        return redirect('/');
    }
}
