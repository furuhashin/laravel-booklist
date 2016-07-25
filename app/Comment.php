<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Comment extends Model
{
    use SoftDeletes;

    /**
     * 日付へキャストする属性
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $fillable = array('body', 'book_id', 'create_id', 'eyecatch');

    /*
     * このコメントを所有するタスクを取得
     */
    public function book()
    {
        return $this->belongsTo('App\Book');
    }

    /*
     * このコメントを所有するユーザを取得
     */
    public function user()
    {
        return $this->belongsTo('App\User','update_id');
    }
}
