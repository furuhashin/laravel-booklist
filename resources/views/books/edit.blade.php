@extends('layouts.app')
@section('content')
    <h1>書籍情報の編集</h1>
    <hr>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::open(['url' =>  "books/update/$id", 'files' => true]) !!}
    <div class="form-group">
        {!! Form::label('title','タイトル:') !!}
        {!! Form::text('title',$book->title,['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('author','著者:') !!}
            @foreach($authors as $author)
        {!! Form::text("authors[$author->id]",$author->name, ['class' => 'form-control']) !!}
        @endforeach
    </div>
    <div class="form-group">
        {!! Form::label('body', '書籍詳細:') !!}
        {!! Form::textarea('body',$book->body, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('deadline', '貸出期限:') !!}
        {!! Form::input('date', 'deadline', $book->deadline,['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('status','ステータス:') !!}
        {!! Form::select('status',['借りれます' => '借りれます','貸出中' => '貸出中','予約中' => '予約中'],$book->status,['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('eyecatch','新規画像:') !!}
        {!! Form::file('eyecatch',['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
    <b>現在の画像</b>
    </div>
    <img src="{{ $book->eyecatch->url('large') }}">
    <hr>
    <div class="form-group">
        <div class="pull-left">
        {!! Form::submit('実行する', ['class' => 'btn btn-primary']) !!}
            {!! link_to('/', '一覧へ戻る', ['class' => 'btn btn-info']) !!}
        </div>
    </div>
    <div>
        {!! Form::hidden('create_id', Auth::user()->id) !!}
        {!! Form::hidden('update_id', Auth::user()->id) !!}

    </div>

    {!! Form::close() !!}
@endsection
