<?php

namespace Tests\Feature;

use App\Artist;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArtistTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testArtistShow()
    {
        $artist =factory(Artist::class)->create();

        $response = $this->json('GET', route('artist.show', ['student' => $artist->id]));

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [ 'id',
                        'name',
                    ]
        ]);
    }
}
