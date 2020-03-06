<?php

namespace Tests\Feature;

use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListStatusesTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function can_get_all_statuses()
    {
        $status1 = factory(Status::class )->create(['created_at' => now()->subDay(4)]);
        $status2 = factory(Status::class )->create(['created_at' => now()->subDay(3)]);
        $status3 = factory(Status::class )->create(['created_at' => now()->subDay(2)]);
        $status4 = factory(Status::class )->create(['created_at' => now()->subDay(1)]);

        $response = $this->getJson(route('statuses.index'));
        $response->assertSuccessful();

        $response->assertJson([
            'total' => 4
        ]);

        $response->assertJsonStructure([
            'data','total','first_page_url','last_page_url'
        ]);

        $this->assertEquals(
            $status4->id,
            $response->json('data.0.id')
        );
    }
}