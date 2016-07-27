<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('authors', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name')->nullable();
            $table->integer('book_id')->unsigned();
            $table->foreign('book_id')->references('id')->on('books');
            $table->integer('create_id')->unsigned();
            $table->foreign('create_id')->references('id')->on('users');
            $table->integer('update_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('authors', function ($table) {
            $table->softDeletes();
        });    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('authors');
    }
}
