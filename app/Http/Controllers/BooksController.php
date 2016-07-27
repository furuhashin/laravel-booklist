<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

//モデルの宣言
use App\Book;


class booksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //一覧の表示
    public function index()
    {
        //usersテーブルのidカラム名とbooksテーブルのidカラム名が重複しているためselectを使用
        //leftjoinするとアイキャッチが消えるため指定
        $books = Book::leftjoin('users','books.borrow_id','=','users.id')
            ->select('books.id as id','title','body','status','deadline','borrow_id','create_id','update_id','eyecatch_file_name','name')->paginate(5);
        //book.indexにbooksという名前で$booksを渡している
        return view('books.index', compact('books'));
    }

    //書籍情報の表示
    public function show($id)
    {
        //usersテーブルのidカラム名とbooksテーブルのidカラム名が重複しているためselectを使用
        //leftjoinするとアイキャッチが消えるため指定
        $book = Book::leftjoin('users','books.borrow_id','=','users.id')
            ->select('books.id as id','title','body','status','name','eyecatch_file_name')->findOrFail($id);

        //usersテーブルのidカラム名とcommentsテーブルのidカラム名が重複しているためselectを使用
        $comments = Book::find($id)->comments()->join('users','comments.create_id','=','users.id')
            ->select('comments.id as id','comments.create_id as create_id','comments.updated_at as updated_at','body','name')->orderby('comments.id','asc')->get();
        return view('books.show', compact('book'),compact('comments'));
    }

    //確認画面の表示
    public function confirm($id)
    {
        $book = Book::findOrFail($id);
        return view('books.confirm',compact('book'));
    }

    //書籍情報の追加画面の表示
    public function create()
    {
        return view('books.add');
    }

    //書籍情報のDBへの追加
    public function store(Request $request)
    {
        
        $this->validate($request,[
            'title' => 'required|min:3',
            'body' => 'required',
            'eyecatch' => 'image|max:2000',
        ]);
        
        
        
        Book::create($request->all());

        \Session::flash('flash_message', '書籍情報の追加に成功しました!');
        return redirect('/');
    }

    //書籍情報の編集
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('books.edit',compact('book'));
    }

    //既存書籍情報の更新
    public function update($id,Request $request)
    {
        $book = Book::findOrFail($id);


        $this->validate($request,[
            'title' => 'required|min:3',
            'eyecatch' => 'image|max:2000',
            'deadline' => 'date',
        ]);

        $book->fill($request->all())->save();

        \Session::flash('flash_message', '書籍情報の編集に成功しました!');
        return redirect('/');
    }

    //既存書籍情報の削除
        public function delete($id)
    {
        if ($id && is_numeric($id)) {

            $books = Book::findOrFail($id);
            $books->delete();

            \Session::flash('flash_message', '書籍情報の削除が完了しました!');
        }else{
            \Session::flash('flash_message', '何か問題が生じ、書籍情報の削除が失敗しました! ');
        }
        return redirect('/');
    }
    
    
}
