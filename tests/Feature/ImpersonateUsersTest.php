<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ImpersonateUsersTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    function non_admins_cannot_impersonate_users()
    {
        $user = factory('App\User')->create();

        $this->get(route('impersonate', $user))
            ->assertRedirect('login');

        $this->actingAs($user)
            ->get(route('impersonate', $user))
            ->assertStatus(403);
    }

    /** @test */
    function admins_can_impersonate_users()
    {
        $admin = factory('App\User')->states('admin')->create();
        $user = factory('App\User')->create();

        $this->actingAs($admin)->get(route('impersonate', $user));

        $this->assertEquals(auth()->id(), $user->id);
    }
}
