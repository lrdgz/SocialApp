<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateStatusTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     * @test
     * @return void
     */
    public function an_authenticated_user_can_create_a_statuses()
    {
        $this->withoutExceptionHandling();

        //1. Given -> Teniendo un usuario autenticado
        $user = factory(User::class)->create();
        $this->actingAs($user);

        //2. When -> Cuando hace un post request a status
        $this->post(route('statuses.store'), ['body' => 'Mi Primer Estado']);

        //3. Then -> Entonces vemos un nuevo estado en la base de datos
        $this->assertDatabaseHas('statuses', ['body' => 'Mi Primer Estado', 'user_id' => $user->id]);
    }
}
