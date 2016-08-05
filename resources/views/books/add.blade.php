@extends('layouts.app')
@section('content')
    <h1>書籍情報の作成</h1>
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

    {!! Form::open(['url' =>  'books', 'files' => true]) !!}
        <div class="form-group">
            {!! Form::label('title','タイトル:') !!}
            {!! Form::text('title',null,['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('author','著者1:') !!}
            {!! Form::text('authors[0]',null,['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('author','著者2:') !!}
            {!! Form::text('authors[1]',null,['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('body', '書籍詳細:') !!}
            {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('status','ステータス:') !!}
            {!! Form::select('status',['借りれます' => '借りれます','貸出中' => '貸出中','予約中' => '予約中'],'', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('eyecatch','画像:') !!}
            {!! Form::file('eyecatch', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            <div class="pull-left">
            {!! Form::submit('追加する', ['class' => 'btn btn-primary']) !!}
            {!! link_to('/', '一覧へ戻る', ['class' => 'btn btn-info']) !!}
            </div>
        </div>
        <div>
            {!! Form::hidden('deadline', 0000-00-00) !!}
            {!! Form::hidden('create_id', Auth::user()->id) !!}
            {!! Form::hidden('update_id', Auth::user()->id) !!}
        </div>

    {!! Form::close() !!}
@endsection
