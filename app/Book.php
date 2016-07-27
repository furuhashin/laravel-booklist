<?php

namespace App;

use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Book extends Model implements StaplerableInterface
{
    //Staplerの読み込み
    use EloquentTrait;
    use SoftDeletes;

    protected $fillable = array('title', 'body', 'status', 'deadline','borrow_id', 'create_id','update_id', 'eyecatch');
    
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
            'url' => '/uploads/books/:id/:style/:filename'
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
        //boot()がbootStaplerをoverrideしてしまうため、再定義
        static::bootStapler();
        // bookレコードを削除した際のイベントを登録
        static::deleted(function ($book) {
            // 関連しているコメントをループ
            //コメントはこのクラスのcommentsメソッドで取得したコメント
            foreach($book->comments as $comment) {
                // 関連している記事を論理削除
                $comment->delete();
            }
        });
        
        // 論理削除したUserレコードを復活した際のイベントを登録
        static::restored(function ($book) {
            foreach($book->getTrashedComments() as $comment) {
                $comment->restore();
            }
        });
    }

    /**
     * 書籍情報のコメントを取得
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /*
     * この書籍情報を所有するユーザを取得
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }


}
