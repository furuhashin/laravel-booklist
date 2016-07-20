@extends('layouts.app')
@section('content')
    <h1>タスク作成</h1>
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

    {!! Form::open(['url' =>  'tasks', 'files' => true]) !!}
        <div class="form-group">
            {!! Form::label('title','タスク名:') !!}
            {!! Form::text('title',null,['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('body', 'タスク詳細:') !!}
            {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('deadline', '期限:') !!}
            {!! Form::input('date', 'deadline', date('Y-m-d'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('status','ステータス:') !!}
            {!! Form::select('status',['未処理' => '未処理','仕掛中' => '仕掛中','完了' => '完了'],'', ['class' => 'form-control']) !!}
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
            {!! Form::hidden('create_id', Auth::user()->id) !!}
        </div>

    {!! Form::close() !!}
@endsection
