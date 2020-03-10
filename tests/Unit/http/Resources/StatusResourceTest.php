<?php

namespace Tests\Unit\http\Resources;

use App\Http\Resources\CommentResource;
use App\Http\Resources\StatusResource;
use App\Models\Comment;
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
        factory(Comment::class )->create(['status_id' => $status->id]);
        $statusResource = StatusResource::make( $status )->resolve();

        /*
            $this->assertArrayHasKey('body', $statusResource);
            $this->assertArrayHasKey('user_name', $statusResource);
            $this->assertArrayHasKey('user_avatar', $statusResource);
            $this->assertArrayHasKey('ago', $statusResource);
        */

        $this->assertEquals($status->id, $statusResource['id']);
        $this->assertEquals($status->body, $statusResource['body']);
        $this->assertEquals($status->user->name, $statusResource['user_name']);
        $this->assertEquals('https://aprendible.com/images/default-avatar.jpg', $statusResource['user_avatar']);
        $this->assertEquals($status->created_at->diffForHumans(), $statusResource['ago']);
        $this->assertEquals(false, $statusResource['is_liked']);
        $this->assertEquals(0, $statusResource['likes_count']);
        $this->assertEquals(CommentResource::class, $statusResource['comments']->collects);
        $this->assertInstanceOf(Comment::class, $statusResource['comments']->collection->first()->resource);

    }
}
