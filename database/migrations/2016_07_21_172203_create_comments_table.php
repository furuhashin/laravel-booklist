<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * マイグレーション実行
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->text('body')->nullable();
            $table->integer('book_id')->unsigned();
            $table->foreign('book_id')->references('id')->on('books');
            $table->integer('create_id')->unsigned();
            $table->foreign('create_id')->references('id')->on('users');
            $table->integer('update_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('comments', function ($table) {
            $table->softDeletes();
        });
    }



    /**
     * マイグレーションを戻す
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('comments');
    }
}
