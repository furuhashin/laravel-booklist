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

        $books = Book::paginate(5);
        //book.indexにbooksという名前で$booksを渡している
        return view('books.index', compact('books'));
    }

    //書籍情報の表示
    public function show($id)
    {
        $book = Book::findOrFail($id);
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
            'deadline' => 'required|date',
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
            'body' => 'required',
            'eyecatch' => 'image|max:2000',
            'deadline' => 'required|date',
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
