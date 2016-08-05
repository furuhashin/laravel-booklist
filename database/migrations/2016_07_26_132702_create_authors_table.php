<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorsTable extends Migration
{
    /**
     * マイグレーション実行
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

        // 書籍と著者の中間テーブル
        Schema::create('author_book', function(Blueprint $table) {
            $table->integer('author_id')->unsigned()->index();
            $table->foreign('author_id')->references('id')->on('authors');
            $table->integer('book_id')->unsigned()->index();
            $table->foreign('book_id')->references('id')->on('books');
            $table->timestamps();
        });

        Schema::table('authors', function ($table) {
            $table->softDeletes();
        });

        Schema::table('author_book', function ($table) {
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
        Schema::drop('authors');
        Schema::drop('author_book');

    }
}
