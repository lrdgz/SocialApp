<?php

namespace Tests\Unit\http\Resources;

use App\Http\Resources\StatusResource;
use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
//use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class StatusResourceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_status_resources_must_have_a_necessary_fields()
    {
        $status = factory(Status::class )->create();
        $statusResource = StatusResource::make( $status )->resolve();

        /*
            $this->assertArrayHasKey('body', $statusResource);
            $this->assertArrayHasKey('user_name', $statusResource);
            $this->assertArrayHasKey('user_avatar', $statusResource);
            $this->assertArrayHasKey('ago', $statusResource);
        */

        $this->assertEquals($status->body, $statusResource['body']);
        $this->assertEquals($status->user->name, $statusResource['user_name']);
        $this->assertEquals('https://aprendible.com/images/default-avatar.jpg', $statusResource['user_avatar']);
        $this->assertEquals($status->created_at->diffForHumans(), $statusResource['ago']);

    }
}
