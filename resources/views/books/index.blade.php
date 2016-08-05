@extends('layouts.app')

    @section('content')
    <h1>
        書籍一覧
    </h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

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
                    <td width="100"><a href="">{{$book->author_name}}</a></td>
                    <td width="100"><a href="{{url('books?keyword='.$book->status)}}">{{$book->status}}</a></td>
                    <td width="100"><a href="{{url('profiles',$book->user_id)}}">{{$book->name}}</a></td>
                    @if(strtotime($book->deadline ) > strtotime((date('Y/m/d'))) or $book->deadline == "0000-00-00")
                        <td width="100">{{ $book->deadline }}</td>
                    @else
                        {{--貸出期限内を過ぎた場合--}}
                        <td width="100" style="background-color: #C20000">{{ $book->deadline }}</td>
                    @endif
                    <td width="100">
                    {{--操作--}}
                    <div class="h-account">
                    <ul>
                        {{--ステータスが借りれますの時のみ借りるボタンを表示--}}
                            @if($book->status == '借りれます')
                            {{--ステータスを貸出中に変更--}}
                        <li>{!! Form::open(['url' => '/books/update/'.$book->id]) !!}
                            {!! Form::hidden('title', $book->title, ['class' => 'form-control']) !!}
                            {!! Form::hidden('body', $book->body, ['class' => 'form-control']) !!}
                            {!! Form::hidden('status', '貸出中', ['class' => 'form-control']) !!}
                            {!! Form::hidden('deadline', date('Y/m/d', strtotime('1 week')), ['class' => 'form-control']) !!}
                            {!! Form::hidden('borrow_id', Auth::user()->id, ['class' => 'form-control']) !!}
                            {!! Form::hidden('update_id', Auth::user()->id, ['class' => 'form-control']) !!}
                            {!! Form::hidden('btn', 1, ['class' => 'form-control']) !!}
                            {!! Form::submit('借りる', ['class' => 'btn btn-primary']) !!}
                            {!! Form::close() !!}
                        </li>
                        @endif
                        {{--ログイン中のユーザが借りた書籍に返却ボタンを表示--}}
                        @if($book->borrow_id == Auth::user()->id)
                        <li>
                            {{--ステータスを借りれますに変更--}}
                            {!! Form::open(['url' => '/books/update/'.$book->id]) !!}
                            {!! Form::hidden('title', $book->title, ['class' => 'form-control']) !!}
                            {!! Form::hidden('body', $book->body, ['class' => 'form-control']) !!}
                            {!! Form::hidden('status', '借りれます', ['class' => 'form-control']) !!}
                            {!! Form::hidden('deadline', "", ['class' => 'form-control']) !!}
                            {!! Form::hidden('borrow_id', null, ['class' => 'form-control']) !!}
                            {!! Form::hidden('update_id', Auth::user()->id, ['class' => 'form-control']) !!}
                            {!! Form::hidden('btn', 1, ['class' => 'form-control']) !!}
                            {!! Form::submit('返却 ', ['class' => 'btn btn-primary']) !!}
                            {!! Form::close() !!}
                        </li>
                        @endif
                    <!-- ドロップダウンメニュー -->
                        <li class="dropdown pull-left">
                            <a href="#" class="dropdown-toggle btn btn-success" data-toggle="dropdown" role="button" aria-expanded="false">その他 <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{url('books/edit',$book->id)}}" class="btn btn-primary">編集</a></li>
                                <li></li>
                                <li><a href="{{url('books',$book->id)}}" class="btn btn-info">詳細 </a></li>
                                {{--ログイン中のユーザーが作成した書籍情報に削除ボタンを表示--}}
                                @if($book->create_id == Auth::user()->id)
                                    <li><a href="{{url('books/confirm',$book->id)}}" class="btn btn-danger">削除 </a></li>
                                @endif
                            </ul>
                        </li>
                    </ul>
                    </div>
                    </td>
                </tr>
            </table>
        </article>
    @endforeach
    {{-- ページネーションリンク --}}
    {!! $books->render() !!}
@endsection
