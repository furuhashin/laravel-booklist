@extends('layouts.app')
    @section('content')
    <h1>
        書籍一覧
        {!! link_to('books/create','書籍情報の新規作成',['class' => 'btn btn-primary']) !!}
        <div class="pull-right">
            {!! link_to('auth/logout','ログアウト',['class' => 'btn btn-danger']) !!}
        </div>
    </h1>


    @if(Session::has('flash_message'))
        <div class="alert alert-success">
            {{ Session::get('flash_message') }}
        </div>
    @endif

    @foreach($books as $book)
        <article>
            <table class="table table-bordered">
                <tr class="info">
                    <th>ID</th>
                    <td><b>サムネイル</b></td>
                    <th>タイトル</th>
                    <th>著者</th>
                    <th>ステータス</th>
                    <th>借用者</th>
                    <th>貸出期限</th>
                    <th>操作</th>
                </tr>
                <tr>
                    <td width="100">{{$book->id}}</td>
                    <td width="120"><img src="{{$book->eyecatch->url('thumb')}}"></td>
                    <td width="200"><a href="{{url('books',$book->id)}}">{{$book->title}}</a></td>
                    <td width="100">
                    <td width="100">{{$book->status}}</td>
                    <td width="100">{{$book->name}}</td>
                    <td width="100">{{ $book->deadline }}</td>
                    <td width="100">
                    <div class="h-account">
                    <ul>
                        {{--ステータスを貸出中に変更--}}
                        <li>{!! Form::open(['url' => '/books/update/'.$book->id]) !!}
                            {!! Form::hidden('title', $book->title, ['class' => 'form-control']) !!}
                            {!! Form::hidden('body', $book->body, ['class' => 'form-control']) !!}
                            {!! Form::hidden('status', '貸出中', ['class' => 'form-control']) !!}
                            {!! Form::hidden('borrow_id', Auth::user()->id, ['class' => 'form-control']) !!}
                            {!! Form::hidden('update_id', Auth::user()->id, ['class' => 'form-control']) !!}
                            {!! Form::submit('借りる', ['class' => 'btn btn-primary']) !!}
                            {!! Form::close() !!}
                        </li>
                        <li>
                            {{--ステータスを借りれますに変更--}}
                            {!! Form::open(['url' => '/books/update/'.$book->id]) !!}
                            {!! Form::hidden('title', $book->title, ['class' => 'form-control']) !!}
                            {!! Form::hidden('body', $book->body, ['class' => 'form-control']) !!}
                            {!! Form::hidden('status', '借りれます', ['class' => 'form-control']) !!}
                            {!! Form::hidden('borrow_id', null, ['class' => 'form-control']) !!}
                            {!! Form::hidden('update_id', Auth::user()->id, ['class' => 'form-control']) !!}
                            {!! Form::submit('返却', ['class' => 'btn btn-primary']) !!}
                            {!! Form::close() !!}
                        </li>
                        <li><a href="{{url('books/edit',$book->id)}}" class="btn btn-primary">編集</a></li>
                        <li><a href="{{url('books',$book->id)}}" class="btn btn-info">詳細</a></li>
                        {{--ログイン中のユーザーが作成した書籍情報は削除できる--}}
                        @if($book->create_id == Auth::user()->id)
                        <li><a href="{{url('books/confirm',$book->id)}}" class="btn btn-danger">削除</a></li>
                    </ul>
                    </div>
                    </td>
                    @endif
                   {{--
                                        <td><div class="body">{{ str_limit($book->body, 300, $end = '...[If you show more, plese click title.]') }}</div></td>
                    --}}
                </tr>
            </table>
        </article>
    @endforeach
    {{-- ページネーションリンク --}}
    {!! $books->render() !!}
@endsection
