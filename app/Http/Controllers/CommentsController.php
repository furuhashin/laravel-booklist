<?php

namespace App\Http\Controllers;
//モデルの宣言
use App\Comment;
use Illuminate\Http\Request;

use App\Http\Requests;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * コメント一覧の表示
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'body' => 'required',
        ]);

        Comment::create($request->all());

        \Session::flash('flash_message', 'コメントの追加に成功しました!');
        return redirect("/books/$request->book_id");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        return view('comments.edit',compact('comment'));    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);

        $this->validate($request,[
            'body' => 'required',
        ]);

        $comment->fill($request->all())->save();

        \Session::flash('flash_message', '本情報の編集に成功しました!');
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        if ($id && is_numeric($id)) {

            $comments = Comment::findOrFail($id);
            $comments->delete();

            \Session::flash('flash_message', 'コメントの削除が完了しました!');
        }else{
            \Session::flash('flash_message', '何か問題が生じ、コメントの削除が失敗しました! ');
        }

        return redirect('/');


    }
}
