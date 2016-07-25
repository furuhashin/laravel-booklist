@extends('layouts.app')
    @section('content')
    <h1>
        タスク一覧
        {!! link_to('tasks/create','タスクの新規作成',['class' => 'btn btn-primary']) !!}
        <div class="pull-right">
            {!! link_to('auth/logout','ログアウト',['class' => 'btn btn-danger']) !!}
        </div>
    </h1>


    @if(Session::has('flash_message'))
        <div class="alert alert-success">
            {{ Session::get('flash_message') }}
        </div>
    @endif

    @foreach($tasks as $task)
        <article>
            <table class="table table-bordered">
                <tr class="info">
                    <th>タスクID</th>
                    <td><b>サムネイル</b></td>
                    <th>タスク名</th>
                    <th>期限</th>
                    <th>ステータス</th>
                    <th colspan="3">コメント操作</th>
                </tr>
                <tr>
                    <td width="100">{{$task->id}}</td>
                    <td width="120"><img src="{{$task->eyecatch->url('thumb')}}"></td>
                    <td width="300"><a href="{{url('tasks',$task->id)}}">{{$task->title}}</a></td>
                    <td width="100">{{ $task->deadline }}</td>
                    <td width="100">{{$task->status}}</td>
                    <td width="100"><a href="{{url('tasks/edit',$task->id)}}" class="btn btn-primary">編集</a></td>
                    <td width="100"><a href="{{url('tasks',$task->id)}}" class="btn btn-info">詳細</a></td>
                    @if($task->create_id == Auth::user()->id)
                    <td width="100"><a href="{{url('tasks/confirm',$task->id)}}" class="btn btn-danger">削除</a></td>
                    @else
                    <td width="100"></td>
                    @endif
                    {{--
                                        <td><div class="body">{{ str_limit($task->body, 300, $end = '...[If you show more, plese click title.]') }}</div></td>
                    --}}
                </tr>
            </table>
        </article>
    @endforeach
    {{-- ページネーションリンク --}}
    {!! $tasks->render() !!}
@endsection
