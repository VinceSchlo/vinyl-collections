<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVinylsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vinyls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('name', 100);
            $table->char('tracklist', 100);
            $table->char('format', 100);
            $table->date('date');
            $table->bigInteger('genre_id')->unsigned()->nullable();
            $table->bigInteger('artist_id')->unsigned()->nullable();
            $table->bigInteger('pochette_id')->unsigned()->nullable();
            $table->timestamps();
            
            $table->foreign('genre_id')->references('id')->on('genres');
            $table->foreign('artist_id')->references('id')->on('artists');
            $table->foreign('pochette_id')->references('id')->on('pochettes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vinyls');
    }
}
