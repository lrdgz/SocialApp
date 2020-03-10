<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CanSeeProfileTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function can_see_profile()
    {
        $this->withoutExceptionHandling();
        factory(User::class )->create(['name' => 'Luis']);
        $this->get('@Luis')->assertSee('Luis');
    }

}
