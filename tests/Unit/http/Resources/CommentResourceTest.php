<?php

namespace Tests\Unit\http\Resources;

use App\Http\Resources\CommentResource;
use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
//use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class CommentResourceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_comment_resources_must_have_a_necessary_fields()
    {
        $comment = factory(Status::class )->create();
        $commentResource = CommentResource::make( $comment )->resolve();

        $this->assertEquals($comment->body, $commentResource['body']);

    }
}
