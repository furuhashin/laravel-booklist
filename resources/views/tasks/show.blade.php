@extends('layouts.app')
@section('content')
    <article>
        <h1>タスク詳細</h1>
        <hr>
        <section style="padding-bottom: 50px;">
            <p class="lead">タイトル： {{ $task->title }}</p>
            <img src="{{ $task->eyecatch->url('large') }}">
            <hr>
            <p class="lead">詳細： {{ $task->body }}</p>
            <hr>
            <p class="lead">ステータス：{{ $task->status }}</p>
            <hr>
            <p class="lead">期限：{{ $task->deadline }}</p>
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