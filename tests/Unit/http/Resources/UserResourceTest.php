<?php

namespace Tests\Unit\http\Resources;

use App\Http\Resources\CommentResource;
use App\Http\Resources\UserResource;
use App\Models\Status;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
//use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class UserResourceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_user_resources_must_have_a_necessary_fields()
    {
        $user = factory(User::class )->create();
        $userResource = UserResource::make( $user )->resolve();

        $this->assertEquals($user->name, $userResource['name']);
        $this->assertEquals($user->link(), $userResource['link']);
        $this->assertEquals($user->avatar(), $userResource['avatar']);

    }
}
