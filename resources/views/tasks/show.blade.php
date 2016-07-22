@extends('layouts.app')
@section('content')
    <article>
        <h1>タスク詳細</h1>
        <hr>
        @if(Session::has('flash_message'))
            <div class="alert alert-success">
                {{ Session::get('flash_message') }}
            </div>
        @endif
        <section style="padding-bottom: 50px;">
            <p class="lead">タイトル： {{ $task->title }}</p>
            <img src="{{ $task->eyecatch->url('medium') }}">
            <hr>
            <p class="lead">詳細： {{ $task->body }}</p>
            <hr>
            <p class="lead">ステータス：{{ $task->status }}</p>

            <p class="lead">期限：{{ $task->deadline }}</p>
            <hr>

            <h3>コメント一覧</h3>
            <hr>
            @foreach($comments as $comment)
                <h4>{{ $comment->id }}</h4>
                <p>{{ $comment->body }}</p><br />
            @endforeach
            {!! Form::open(['action' => 'CommentsController@store']) !!}
            <div class="form-group">
                <div>
                    <h3>コメントする</h3>
                    {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
                    {!! Form::submit('コメントを投稿する', ['class' => 'btn btn-primary']) !!}
                    {!! Form::hidden('create_id', Auth::user()->id) !!}
                    {!! Form::hidden('task_id',$task->id) !!}
                </div>
            </div>
            {!! Form::close() !!}

            <hr>
            <div style="margin-bottom: 75px;">
                <div class="pull-left" style="padding-right: 5px ">
                    {!! link_to('tasks/edit/' . $task->id, '編集する', ['class' => 'btn btn-primary']) !!}
                </div>
                <div class="pull-left">
                    {!! link_to('/', '一覧へ戻る', ['class' => 'btn btn-info']) !!}
                </div>
            </div>
            <hr style="clear:both;" />
        </section>
    </article>
@endsection
