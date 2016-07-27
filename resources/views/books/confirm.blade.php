@extends('layouts.app')
@section('content')

    <article>
        <h1>以下の書籍を削除します</h1>
        <hr>
        <h3>タイトル：    {{ $book->title }}</h3>
        <hr>
        <section style="padding-bottom: 50px;">
            <img src="{{ $book->eyecatch->url('large') }}">
            <hr>
            <p class="lead">詳細： {{ $book->body }}</p>
            <hr>
            <p class="lead">ステータス：{{ $book->status }}</p>
            <hr>
            <p class="lead">貸出期限：{{ $book->deadline }}</p>
            <hr>
            <div style="margin-bottom: 75px;">
                <div class="pull-left" style="padding-right: 5px ">
                    {!! Form::open(['url' => 'books/delete/'.$book->id]) !!}
                    {!! Form::submit('削除する', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </div>
                <div class="pull-left">
                    {!! link_to('/', '一覧へ戻る', ['class' => 'btn btn-info']) !!}
                </div>
            </div>
            <hr style="clear:both;" />
        </section>
    </article>
@endsection
