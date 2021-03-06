<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UserCanCreateStatusesTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @test
     * @throws \Throwable
     */
    public function users_can_create_statuses()
    {

        $user = factory(User::class)->create();
        $this->actingAs($user);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->visit('/')
                    ->type('body', 'Mi Primer status')
                    ->press('#create-status')
                    ->waitForText('Mi Primer status')
                    ->assertSee('Mi Primer status')
                    ->assertSee($user->name)
            ;
        });
    }
}
