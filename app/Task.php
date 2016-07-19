<?php

namespace App;

use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

use Illuminate\Database\Eloquent\Model;

class Task extends Model implements StaplerableInterface
{
    //Staplerの読み込み
    use EloquentTrait;

    protected $fillable = array('title', 'body', 'status', 'deadline', 'create_id', 'eyecatch');

    //コンストラクタ
    public function __construct(array $attributes = array()) {

        //画像の投稿設定
        $this->hasAttachedFile('eyecatch', [

            //画像の切り取るサイズのパターン
            'styles' => [
                'large' => '640x480#',
                'medium' => '300x200#',
                'thumb' => '100x75#'
            ],

            //格納ディレクトリ(public配下からのパス)
            'url' => '/uploads/tasks/:id/:style/:filename'
        ]);
        parent::__construct($attributes);
    }
}
