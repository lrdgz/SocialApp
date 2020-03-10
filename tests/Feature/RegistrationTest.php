<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function users_can_register()
    {

        $response = $this->post(route('register'), $this->userValidData());
        $response->assertRedirect('/');

        $this->assertDatabaseHas('users', [
            'name' => 'LuisRodriguez',
            'email' => 'luis@dev.com',
            'first_name' => 'Luis',
            'last_name' => 'Rodriguez',
        ]);

        $this->assertTrue(Hash::check('Password', User::first()->password));
    }

    /**
     * @test
     */
    public function the_name_is_required()
    {
        $response = $this->post(route('register'), $this->userValidData(['name' => null]));
        $response->assertSessionHasErrors('name');
    }

    /**
     * @test
     */
    public function the_name_must_be_unique()
    {
        factory(User::class)->create(['name' => 'LuisRodriguez']);
        $response = $this->post(route('register'), $this->userValidData(['name' => 'LuisRodriguez']));
        $response->assertSessionHasErrors('name');
    }

    /**
     * @test
     */
    public function the_name_may_only_contain_letters_and_numbers()
    {
        $response = $this->post(route('register'), $this->userValidData(['name' => 'Luis Rodriguez2']));
        $response->assertSessionHasErrors('name');
    }

    /**
     * @test
     */
    public function the_name_must_be_at_least_3_characters()
    {
        $response = $this->post(route('register'), $this->userValidData(['name' => 'st']));
        $response->assertSessionHasErrors('name');
    }

    /**
     * @test
     */
    public function the_name_must_be_a_string()
    {
        $response = $this->post(route('register'), $this->userValidData(['name' => 123456]));
        $response->assertSessionHasErrors('name');
    }

    /**
     * @test
     */
    public function the_name_may_not_be_greater_than_255_characters()
    {
        $response = $this->post(route('register'), $this->userValidData(['name' => Str::random(256)]));
        $response->assertSessionHasErrors('name');
    }

    /**
     * @test
     */
    public function the_first_name_is_required()
    {
        $response = $this->post(route('register'), $this->userValidData(['first_name' => null]));
        $response->assertSessionHasErrors('first_name');
    }

    /**
     * @test
     */
    public function the_first_name_must_be_at_least_3_characters()
    {
        $response = $this->post(route('register'), $this->userValidData(['first_name' => 'st']));
        $response->assertSessionHasErrors('first_name');
    }

    /**
     * @test
     */
    public function the_first_name_may_only_contain_letters()
    {
        $response = $this->post(route('register'), $this->userValidData(['first_name' => 'test03']));
        $response->assertSessionHasErrors('first_name');
    }


    /**
     * @test
     */
    public function the_first_name_must_be_a_string()
    {
        $response = $this->post(route('register'), $this->userValidData(['first_name' => 123456]));
        $response->assertSessionHasErrors('first_name');
    }

    /**
     * @test
     */
    public function the_first_name_may_not_be_greater_than_255_characters()
    {
        $response = $this->post(route('register'), $this->userValidData(['first_name' => Str::random(256)]));
        $response->assertSessionHasErrors('first_name');
    }

    /**
     * @test
     */
    public function the_last_name_is_required()
    {
        $response = $this->post(route('register'), $this->userValidData(['last_name' => null]));
        $response->assertSessionHasErrors('last_name');
    }

    /**
     * @test
     */
    public function the_last_name_must_be_at_least_3_characters()
    {
        $response = $this->post(route('register'), $this->userValidData(['last_name' => 'st']));
        $response->assertSessionHasErrors('last_name');
    }

    /**
     * @test
     */
    public function the_last_name_may_only_contain_letters()
    {
        $response = $this->post(route('register'), $this->userValidData(['last_name' => 'test03']));
        $response->assertSessionHasErrors('last_name');
    }

    /**
     * @test
     */
    public function the_last_name_must_be_a_string()
    {
        $response = $this->post(route('register'), $this->userValidData(['last_name' => 123456]));
        $response->assertSessionHasErrors('last_name');
    }

    /**
     * @test
     */
    public function the_last_name_may_not_be_greater_than_255_characters()
    {
        $response = $this->post(route('register'), $this->userValidData(['last_name' => Str::random(256)]));
        $response->assertSessionHasErrors('last_name');
    }

    /**
     * @test
     */
    public function the_email_is_required()
    {
        $response = $this->post(route('register'), $this->userValidData(['email' => null]));
        $response->assertSessionHasErrors('email');
    }

    /**
     * @test
     */
    public function the_email_must_be_a_string()
    {
        $response = $this->post(route('register'), $this->userValidData(['email' => 123456]));
        $response->assertSessionHasErrors('email');
    }

    /**
     * @test
     */
    public function the_email_must_be_a_valid_email_address()
    {
        $response = $this->post(route('register'), $this->userValidData(['email' => 'invalid.']));
        $response->assertSessionHasErrors('email');
    }

    /**
     * @test
     */
    public function the_email_must_be_unique()
    {
        factory(User::class)->create(['email' => 'dev@dev.com']);
        $response = $this->post(route('register'), $this->userValidData(['email' => 'dev@dev.com']));
        $response->assertSessionHasErrors('email');
    }

    /**
     * @test
     */
    public function the_email_may_not_be_greater_than_255_characters()
    {
        $response = $this->post(route('register'), $this->userValidData(['email' => Str::random(256)]));
        $response->assertSessionHasErrors('email');
    }

    /**
     * @test
     */
    public function the_password_is_required()
    {
        $response = $this->post(route('register'), $this->userValidData(['password' => null]));
        $response->assertSessionHasErrors('password');
    }

    /**
     * @test
     */
    public function the_password_must_be_a_string()
    {
        $response = $this->post(route('register'), $this->userValidData(['password' => 123456]));
        $response->assertSessionHasErrors('password');
    }


    /**
     * @test
     */
    public function the_password_must_be_at_least_6_characters()
    {
        $response = $this->post(route('register'), $this->userValidData(['password' => 'test']));
        $response->assertSessionHasErrors('password');
    }

    /**
     * @test
     */
    public function the_password_must_be_confirmed()
    {
        $response = $this->post(route('register'), $this->userValidData(['password' => 'Password', 'password_confirmation' => null]));
        $response->assertSessionHasErrors('password');
    }
    /**
     * @return array
     */
    public function userValidData($overrides = []): array
    {
        return array_merge([
            'name' => 'LuisRodriguez',
            'first_name' => 'Luis',
            'last_name' => 'Rodriguez',
            'email' => 'luis@dev.com',
            'password' => 'Password',
            'password_confirmation' => 'Password',
        ], $overrides);
    }
}
