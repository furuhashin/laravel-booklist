@extends('layouts.app')
@section('content')

    {!! Form::open(['url' => 'auth/login']) !!}
    {!! csrf_field() !!}

    <div class="form-group">
        {!! Form::label('title','メールアドレス:') !!}
        {!! Form::text('email','',['value' => "{{ old('email') }}",'class' => 'form-control','placeholder' => "ユーザーIDを入力してください"]) !!}
        @if ($errors->has('email'))
            <div class="errors"><p>{!! $errors->first('email') !!}</p></div>
        @endif
    </div>

    <div class="form-group">
        {!! Form::label('title','パスワード:') !!}
        {!! Form::password('password', ['class' => 'form-control','placeholder' => "パスワードを入力してください"]) !!}
        @if ($errors->has('password'))
            <div class="errors"><p>{!! $errors->first('password') !!}</p></div>
        @endif
    </div>

    <div>
        {!! Form::label('title','ログインを継続する:') !!}
        {!! Form::checkbox('remember', 'value') !!}
    </div>

    <div>
        {!! Form::submit('ログイン', ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
@endsection