<?php

namespace Tests\Unit;

use App\Artist;
use App\Genre;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DatabaseTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testArtistInsert()
    {
        $table = 'artists';
        $artist = factory(Artist::class)->create();

        $this->assertDatabaseHas($table, $artist->toArray());
    }

    public function testGenreInsert()
    {
        $table = 'genres';
        $genre = factory(Genre::class)->create();

        $this->assertDatabaseHas($table, $genre->toArray());
    }
}
