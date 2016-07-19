<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * マイグレーション実行
     *
     * @return void
     */
    public function up()
    {
        //tasksテーブルを生成する
        Schema::create('tasks', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('body')->nullable();
            $table->string('status',20);
            $table->date('deadline')->nullable();
            $table->tinyInteger('delete_flg')->unsigned()->default(0);
            $table->integer('create_id')->unsigned();
            $table->integer('update_id')->unsigned();
            //created_at,update_date
            $table->timestamps();
            //Add columns for Laravel Stapler
            $table->string('eyecatch_file_name', 256);
            $table->integer('eyecatch_file_size');
            $table->string('eyecatch_content_type', 256);
            $table->timestamp('eyecatch_updated_at');
        });

        Schema::table('tasks',function($table){
           $table->foreign('create_id')->references('id')->on('users');
        });
    }

    /**
     * マイグレーションを戻す
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tasks');
    }
}
