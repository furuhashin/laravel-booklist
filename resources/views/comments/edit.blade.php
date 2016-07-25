@extends('layouts.app')
@section('content')
    <h1>コメント編集</h1>
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

    {!! Form::open(['url' =>  "comments/update/$comment->id"]) !!}
    <div class="form-group">
        {!! Form::label('title','コメント内容:') !!}
        {!! Form::text('body',$comment->body,['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        <div class="pull-left">
            {!! Form::submit('実行する', ['class' => 'btn btn-primary']) !!}
            {!! link_to('/', '一覧へ戻る', ['class' => 'btn btn-info']) !!}
        </div>
    </div>
    <div>
        {!! Form::hidden('create_id', Auth::user()->id) !!}
    </div>

    {!! Form::close() !!}
@endsection
