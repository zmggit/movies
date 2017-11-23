<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIpMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ip_movies', function (Blueprint $table) {
            $table->charset='utf8';
            $table->collation = 'utf8_general_ci';

            $table->increments('id');
            $table->integer('ip_id')->unsigned()->index();
            $table->foreign('ip_id')->references('id')->on('ip');

            $table->integer('movies_id')->unsigned()->index();
            $table->foreign('movies_id')->references('id')->on('movies');

            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ip_movies');
    }
}
