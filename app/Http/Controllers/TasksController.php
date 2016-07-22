<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

//モデルの宣言
use App\User;
use App\Task;
use App\Comment;


class TasksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //一覧の表示
    public function index()
    {

        $tasks = Task::paginate(5);
        //task.indexにtasksという名前で$tasksを渡している
        return view('tasks.index', compact('tasks'));
    }

    //タスクの表示
    public function show($id)
    {
        $task = Task::findOrFail($id);
        $comments = Task::find($id)->comments()->join('users','comments.update_id','=','users.id')->get();
        return view('tasks.show', compact('task'),compact('comments'));
    }

    //確認画面の表示
    public function confirm($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.confirm',compact('task'));
    }

    //タスクの追加画面の表示
    public function create()
    {
        return view('tasks.add');
    }

    //タスクのDBへの追加
    public function store(Request $request)
    {

        $this->validate($request,[
            'title' => 'required|min:3',
            'body' => 'required',
            'eyecatch' => 'image|max:2000',
            'deadline' => 'required|date',
        ]);
        
        Task::create($request->all());

        \Session::flash('flash_message', 'タスクの追加に成功しました!');
        return redirect('/');
    }

    //タスクの編集
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit',compact('task'));
    }

    //既存タスクの更新
    public function update($id,Request $request)
    {
        $task = Task::findOrFail($id);

        $this->validate($request,[
            'title' => 'required|min:3',
            'body' => 'required',
            'eyecatch' => 'image|max:2000',
            'deadline' => 'required|date',
        ]);

        $task->fill($request->all())->save();

        \Session::flash('flash_message', 'タスクの編集に成功しました!');
        return redirect('/');
    }

    //既存タスクの削除
    public function delete(Request $request)
    {
        $target_id = $request->id;

        if ($target_id && is_numeric($target_id)) {

            $tasks = Task::findOrFail($target_id);
            $tasks->delete();

            \Session::flash('flash_message', 'タスクの削除が完了しました!');
        }else{
            \Session::flash('flash_message', '何か問題が生じ、タスクの削除が失敗しました! ');
        }
        return redirect('/');
    }
}
