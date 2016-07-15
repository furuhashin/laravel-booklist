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

    {!! Form::open(['url' =>  'tasks/create', 'files' => true]) !!}
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
            {!! Form::input('date', 'published', date('Y-m-d'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('eyecatch','画像:') !!}
            {!! Form::file('eyecatch', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Add Topic', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    {!! Form::close() !!}
@endsection