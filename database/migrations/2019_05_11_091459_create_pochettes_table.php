<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePochettesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pochettes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('image', 250);
            $table->char('illustrator', 100);
            $table->bigInteger('vinyl_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('vinyl_id')->references('id')->on('vinyls');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pochettes');
    }
}
