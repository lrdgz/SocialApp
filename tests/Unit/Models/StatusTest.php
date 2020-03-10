<?php

namespace Tests\Unit\Models;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Status;
use App\Traits\HasLikes;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
//use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class StatusTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_status_belongs_to_a_user()
    {
        $status = factory(Status::class )->create();
        $this->assertInstanceOf( User::class, $status->user );
    }

    /**
     * @test
     */
    public function a_status_morph_many_likes()
    {
        $status = factory(Status::class )->create();
        factory(Like::class )->create([
            'likeable_id' => $status->id,
            'likeable_type' => get_class($status)
        ]);

        $this->assertInstanceOf( Like::class, $status->likes->first() );
    }

    /**
     * @test
     */
    public function a_status_morph_many_comments()
    {
        $status = factory(Status::class )->create();
        $user = factory(User::class)->create();
        factory(Comment::class )->create(['status_id' => $status->id, 'user_id' => $user->id]);
        $this->assertInstanceOf( Comment::class, $status->comments->first() );
    }

    /**
     * @test
     */
    public function a_status_can_be_like_and_unlike()
    {
        $status = factory(Status::class )->create();
        $this->actingAs(factory(User::class)->create());
        $status->like();
        $this->assertEquals(1, $status->fresh()->likes->count());

        $status->unlike();
        $this->assertEquals(0, $status->fresh()->likes->count());
    }

    /**
     * @test
     */
    public function a_status_can_be_liked_once()
    {
        $status = factory(Status::class )->create();
        $this->actingAs(factory(User::class)->create());

        $status->like();
        $this->assertEquals(1, $status->likes->count());

        $status->like();
        $this->assertEquals(1, $status->fresh()->likes->count());
    }

    /**
     * @test
     */
    public function a_status_knows_if_it_has_been_liked()
    {
        $status = factory(Status::class )->create();
        $this->assertFalse($status->isLiked());

        $this->actingAs(factory(User::class)->create());
        $this->assertFalse($status->isLiked());
        $status->like();
        $this->assertTrue($status->isLiked());
    }

    /**
     * @test
     */
    public function a_status_knows_how_many_likes_it_has()
    {
        $status = factory(Status::class )->create();
        $this->assertEquals(0, $status->likesCount());

        factory(Like::class, 2 )->create([
            'likeable_id' => $status->id,
            'likeable_type' => get_class($status)
        ]);

        $this->assertEquals(2, $status->likesCount());
    }


    /**
     * @test
     */
    public function a_comment_model_must_use_the_trait_has_likes()
    {
        $this->assertClassUsesTrait(HasLikes::class, Comment::class);
    }
}
