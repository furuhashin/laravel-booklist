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
                    <th>貸出期限</th>
                    <th>ステータス</th>
                    <th colspan="3">操作</th>
                </tr>
                <tr>
                    <td width="100">{{$book->id}}</td>
                    <td width="120"><img src="{{$book->eyecatch->url('thumb')}}"></td>
                    <td width="300"><a href="{{url('books',$book->id)}}">{{$book->title}}</a></td>
                    <td width="100">{{ $book->deadline }}</td>
                    <td width="100">{{$book->status}}</td>
                    <td width="100"><a href="{{url('books/edit',$book->id)}}" class="btn btn-primary">編集</a></td>
                    <td width="100"><a href="{{url('books',$book->id)}}" class="btn btn-info">詳細</a></td>
                    @if($book->create_id == Auth::user()->id)
                    <td width="100"><a href="{{url('books/confirm',$book->id)}}" class="btn btn-danger">削除</a></td>
                    @else
                    <td width="100"></td>
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
