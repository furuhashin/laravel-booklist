<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Book;

class SendEmails extends Command
{
    /**
     * コンソールコマンドの識別名
     *
     * @var string
     */
    protected $signature = 'emails:send';

    /**
     * コンソールコマンドの説明
     *
     * @var string
     */
    protected $description = '貸出期限を過ぎた本を持っているユーザに返却を迫るメールを送信する';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * コンソールコマンドの実行
     *
     * @return mixed
     */
    public function handle()
    {
        //貸出期限を過ぎている書籍を返却していないユーザのメールアドレスを重複なしで取得
        $emails = Book::join('users','books.borrow_id','=','users.id')->where('deadline','<',date('Y/m/d'))->where('deadline', '!=', '0000-00-00')->distinct()->lists('email');
        foreach ($emails as $email) {
            //メールアドレスに紐付けられている貸出期限を過ぎている書籍を取得
            $books = Book::join('users','books.borrow_id','=','users.id')
                ->where('deadline','<',date('Y/m/d'))->where('deadline', '!=', '0000-00-00')->where('email','=',$email)->get();
            
            //貸出期限を過ぎている書籍を返却していないユーザをメールアドレスで検索して重複なしで取得
            $user = Book::join('users','books.borrow_id','=','users.id')
                ->where('deadline','<',date('Y/m/d'))->where('deadline', '!=', '0000-00-00')->where('email','=',$email)->distinct()->firstOrFail();

            \Mail::send('emails.alert',compact('books','user'), function ($message) use ($email) {
                $message->to($email)
                    ->subject('テスト送信');
            });
        }
    }
}
