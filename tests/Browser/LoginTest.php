<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{

    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @test
     * @return void
     * @throws \Throwable
     */
    public function registered_users_can_login()
    {
        $user = factory(User::class)->create(['email' => 'master@socialapp.com']);
        $this->actingAs($user);

        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email','master@socialapp.com')
                    ->type('password','password')
                    ->press("#login-btn")
                    ->assertPathIs('/')
                    ->assertAuthenticated()
                ;
        });
    }
}
