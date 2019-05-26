<?php

namespace Tests\Feature;

use App\Artist;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArtistTest extends TestCase
{
    /**
     *
     * @return void
     */
    public function testArtistShow()
    {
        $artist = factory(Artist::class)->create();

        $response = $this->json('GET', route('artist.show', ['student' => $artist->id]));

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [ 'id',
                        'name',
                    ]
        ]);
    }

    public function testArtistIndex()
    {
//        $artist =factory(Artist::class, 10)->make();

        $response = $this->json('GET', route('artist.index'));

        $response->assertStatus(200);

        $response->assertJsonStructure([
            "data" => [
                [
                    "id",
                    "name"
                ]
            ],
            "links" => [
                "first",
                "last",
                "prev",
                "next"
            ],
            "meta" => [
                "current_page",
                "from",
                "last_page",
                "path",
                "per_page",
                "to",
                "total"
            ]
        ]);
    }
}
