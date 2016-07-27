<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * マイグレーション実行
     *
     * @return void
     */
    public function up()
    {
        //booksテーブルを生成する
        Schema::create('books', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('body')->nullable();
            $table->string('status',20);
            $table->date('deadline')->nullable();
            $table->integer('borrow_id')->unsigned();
            $table->integer('create_id')->unsigned();
            $table->foreign('create_id')->references('id')->on('users');
            $table->integer('update_id')->unsigned();
            $table->foreign('update_id')->references('id')->on('users');

            //created_at,update_date
            $table->timestamps();
            //Add columns for Laravel Stapler
            $table->string('eyecatch_file_name', 256);
            $table->integer('eyecatch_file_size');
            $table->string('eyecatch_content_type', 256);
            $table->timestamp('eyecatch_updated_at');
        });

        Schema::table('books', function ($table) {
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
        Schema::drop('books');
    }
}
