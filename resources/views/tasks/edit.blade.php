@extends('layouts.app')
@section('content')
    <h1>タスク編集</h1>
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

    {!! Form::open(['url' =>  "tasks/update/$task->id", 'files' => true]) !!}
    <div class="form-group">
        {!! Form::label('title','タスク名:') !!}
        {!! Form::text('title',$task->title,['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('body', 'タスク詳細:') !!}
        {!! Form::textarea('body',$task->body, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('deadline', '期限:') !!}
        {!! Form::input('date', 'deadline', $task->deadline,['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('status','ステータス:') !!}
        {!! Form::select('status',['未処理' => '未処理','仕掛中' => '仕掛中','完了' => '完了'],$task->status,['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('eyecatch','新規画像:') !!}
        {!! Form::file('eyecatch',['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
    <b>現在の画像</b>
    </div>
    <img src="{{ $task->eyecatch->url('large') }}">

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
