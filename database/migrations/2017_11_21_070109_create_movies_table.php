<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->charset='utf8';
            $table->collation = 'utf8_general_ci';

            $table->increments('id');
            $table->string('title',50);
            $table->integer('time')->nullable();
            $table->string('describe',500);
            $table->integer('collection')->default('0');
            $table->integer('collection_status')->default('0');
            $table->string('mv_url')->nullable();
            $table->string('status')->default('0');
            $table->integer('sort_id')->unsigned()->nullable();
            $table->foreign('sort_id')->references('id')->on('mv_sort');
            $table->string('filed_id');
            $table->string('weight')->nullable();

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
        Schema::dropIfExists('movies');
    }
}
