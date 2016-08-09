<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Author extends Model
{
    use SoftDeletes;

    /**
     * 日付へキャストする属性
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $fillable = array('name', 'book_id', 'create_id', 'update_id');

    /*
     * この著者を所有する書籍情報を取得
     */
    public function books()
    {
        return $this->belongsToMany('App\Book')->withTimestamps();
    }


    /*
     * この著者を所有するユーザを取得
     */
    public function user()
    {
        return $this->belongsTo('App\User','create_id');
    }
}
