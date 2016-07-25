<?php

namespace App;

use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Task extends Model implements StaplerableInterface
{
    //Staplerの読み込み
    use EloquentTrait;
    use SoftDeletes;

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

    /**
     * 日付へキャストする属性
     *
     * @var array
     */
    //ソフトデリート用プロパティ
    protected $dates = ['deleted_at'];

    //親レコードを削除、復活させた場合に子レコードにもそれを適用
    public static function boot()
    {
        parent::boot();
        // taskレコードを削除した際のイベントを登録
        static::deleted(function ($task) {
            // 関連しているコメントをループ
            //コメントはこのクラスのcommentsメソッドで取得したコメント
            foreach($task->comments as $comment) {
                // 関連している記事を論理削除
                $comment->delete();
            }
        });
        
        // 論理削除したUserレコードを復活した際のイベントを登録
        static::restored(function ($task) {
            foreach($task->getTrashedComments() as $comment) {
                $comment->restore();
            }
        });
    }

    /**
     * タスクリストのコメントを取得
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /*
     * このタスクを所有するユーザを取得
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }


}
