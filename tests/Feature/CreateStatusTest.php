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
     * @test
     * @return void
     */
    public function guests_users_can_not_create_statuses()
    {
        $response = $this->post(route('statuses.store'), ['body' => 'Mi Primer Estado']);
        $response->assertRedirect('/login');
    }

    /**
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
        $response = $this->postJson(route('statuses.store'), ['body' => 'Mi Primer Estado']);
        $response->assertJson(['data' => ['body' => 'Mi Primer Estado']]);

        //3. Then -> Entonces vemos un nuevo estado en la base de datos
        $this->assertDatabaseHas('statuses', ['body' => 'Mi Primer Estado', 'user_id' => $user->id]);
    }

    /**
     * @test
     * @return void
     */
    public function a_status_requires_a_body()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->postJson(route('statuses.store'), ['body' => '']);
        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message',
            'errors' => ['body']
        ]);

    }

    /**
     * @test
     * @return void
     */
    public function a_status_body_requires_a_minimum_length()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->postJson(route('statuses.store'), ['body' => 'test']);
        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message',
            'errors' => ['body']
        ]);

    }
}
