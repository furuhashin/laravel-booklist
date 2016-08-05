<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

//モデルの宣言
use App\Book;
use App\Author;



class booksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //一覧の表示
    public function index()
    {
        //書籍の全一覧を取得するためleftjoinを使用(hasmany,belongstoだと制限される)
        //重複カラム名にasで名前付けをするためにselectを使用
        //books.id as idにしないとなぜかアイキャッチが消える
        //borrow_idがないと返却ボタンが消える
        //leftjoinするとアイキャッチが消えるためeyecatch_file_nameを指定
        //create_idは削除ボタンを表示するため
        $books = Book::leftjoin('users','books.borrow_id','=','users.id')
            ->leftjoin('authors','books.id','=','authors.book_id')
            ->select('books.id as id','users.id as user_id','title','body','status','deadline',
                'borrow_id','books.create_id as create_id','eyecatch_file_name','users.name as name','authors.name as author_name')
            ->distinct('id')
            ->paginate(5);

        //book.indexにbooksという名前で$booksを渡している
        return view('books.index', compact('books'));

    }

    //書籍情報の表示
    public function show($id)
    {
        //usersテーブルのidカラム名とbooksテーブルのidカラム名が重複しているためselectを使用
        //leftjoinするとアイキャッチが消えるため指定
        $book = Book::leftjoin('users','books.borrow_id','=','users.id')
            ->leftjoin('authors','books.id','=','authors.book_id')
            ->select('books.id as id','users.id as user_id','title','body','status','deadline',
                'eyecatch_file_name','users.name as name','authors.name as author_name')
            ->findOrFail($id);

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

        $book = Book::create($request->all());

        //著者は複数考えられるためforeachを使用
        foreach ($request->authors as $author){
            if ($author !== '') {
                Author::create(["name" => "$author","book_id" => "$book->id",
                    "create_id" => "$request->create_id","update_id" => "$request->update_id"]);
            }
        }

        \Session::flash('flash_message', '書籍情報の追加に成功しました!');
        return redirect('/');
    }

    //書籍情報の編集
    public function edit($id)
    {
        //重複カラム名がないのでselectを使用していない
        $book = Book::leftjoin('authors','books.id','=','authors.book_id')->findOrFail($id);
        
        return view('books.edit',compact('book','id'));
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
        //このリターンバック何？
        /*        return back();*/
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

    //検索
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $statuses = array("1" => "貸出中","借りれます");

        $this->validate($request,[
            'keyword' => 'required',
        ]);
        //ステータスをクリックした場合(フォームからの検索でも正常に動く)
        if (array_search($keyword,$statuses)) {
            $books = Book::leftjoin('users','books.borrow_id','=','users.id')
                ->where('status', 'LIKE', "%$keyword%")
                ->select('books.id as id','users.id as user_id','title','body','status','deadline','borrow_id','create_id','update_id','eyecatch_file_name','name')
                ->paginate(5);
        //フォームからの検索の場合
        }elseif($keyword){
            $books = Book::leftjoin('users','books.borrow_id','=','users.id')
                ->where('title', 'LIKE', "%$keyword%")
                ->select('books.id as id','users.id as user_id','title','body','status','deadline','borrow_id','create_id','update_id','eyecatch_file_name','name')
                ->paginate(5);
        //空白で検索した場合は全一覧とバリデーションNGのメッセージを表示
        }else{
            $books = Book::paginate(5);
        }

        return view('books.index',compact('books'));
    }
}
