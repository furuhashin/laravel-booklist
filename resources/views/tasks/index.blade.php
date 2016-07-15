@extends('layouts.app')
    @section('section')
    <h1>
        タスクリスト
    </h1>
    <hr>

    @if(Session::has('flash_message'))
        <div class="alert alert-success">
            {{ Session::get('flash_message') }}
        </div>
    <hr>
    @endif

    @foreach($tasks as $task)
        <article>
            <table class="table table-bordered">
                <tr class="info">
                    <th colspan="3"><span>[タスクID:{{$task->id}}]<a href="{{url('tasks',$task->id)}}">{{$task->title}}</a></span></th>
                </tr>
                <tr>
                    <td width="100"><b>サムネイル画像</b></td>
                    <td><b>タスク名</b></td>
                    <td width="100"><b>日付</b></td>
                </tr>
                <tr>
                    <td width="100"><img src="{{$tasks->eyecatch->url('thumb')}}"></td>
                    <td><div class="body">{{ str_limit($task->body, 300, $end = '...[If you show more, plese click title.]') }}</div></td>
                    <td width="100">{{ $task->deadline }}</td>
                </tr>
            </table>
        </article>
        <hr>
    @endforeach
        {!! link_to('tasks/add','新規作成',['class' => 'btn btn-primary']) !!}
@endsection