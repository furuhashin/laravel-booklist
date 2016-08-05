@extends('layouts.app')
@section('script')
    $(function(){
    $(".btn-danger").click(function(){
    if(confirm("本当に削除しますか？")){
    //そのままsubmit（削除）
    }else{
    //cancel
    return false;
    }
    });
    });
@endsection
@section('content')
    <article>
        <h1>書籍詳細</h1>
        <hr>
        @if(Session::has('flash_message'))
            <div class="alert alert-success">
                {{ Session::get('flash_message') }}
            </div>
        @endif
        <section style="padding-bottom: 50px;">
            <table>
                <tr>
                    <td>
                    <img src="{{ $book->eyecatch->url('medium') }}">
                    </td>
                    <td style="padding-left: 30px">
                    <p class="lead">タイトル： {{ $book->title }}</p>
                    <p class="lead">著者：
                        @foreach($authors as $author)
                        {{ $author->name}}
                        @endforeach
                    </p>
                    <p class="lead">ステータス：<a href="{{url('books?keyword='.$book->status)}}">{{$book->status}}</a></p>
                    <p class="lead">借用者：<a href="{{url('profiles',$book->user_id)}}">{{$book->name}}</a></p>
                    <p class="lead">貸出期限：{{ $book->deadline }}</p>
                    </td>
                </tr>
            </table>
            <h3>詳細</h3>
            <hr>
                <p class="lead">{{ $book->body }}</p>

            <hr>
            <h3>コメント一覧</h3>
            <hr>
            {{--コメント欄に付くコメントカウント用--}}
            <?php $i = 1;?>

            @foreach($comments as $comment)
                <table class="table table-bordered">
                    <tr class="info">
                        <td>
                            {{$i}} 名前: {{ $comment->name }}　投稿日時：{{ $comment->updated_at }}
                        </td>
                    </tr>
                    <tr>
                        <td>{{ $comment->body  }}
                            @if($comment->create_id == Auth::user()->id)
                                <div class="pull-right" >
                                <a href="{{url('comments/edit',$comment->id)}}" class="btn btn-primary">編集</a>
                                <div class="pull-right" >
                                {!! Form::open(['url' => 'comments/delete/'.$comment->id]) !!}
                                {!! Form::submit('削除する', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                                @endif
                            </div>
                        </div>
                        </td>
                    </tr>
                </table>
                <?php $i++ ;?>
            @endforeach
            {!! Form::open(['action' => 'CommentsController@store']) !!}
            <div class="form-group">
                <div>
                    <h3>コメントする</h3>
                    {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
                    {!! Form::submit('コメントを投稿する', ['class' => 'btn btn-primary']) !!}
                    {!! Form::hidden('create_id', Auth::user()->id) !!}
                    {!! Form::hidden('book_id',$book->id) !!}
                </div>
            </div>
            {!! Form::close() !!}

            <hr>
            <div style="margin-bottom: 75px;">
                <div class="pull-left" style="padding-right: 5px ">
                    {!! link_to('books/edit/' . $book->id, '書籍情報を編集する', ['class' => 'btn btn-primary']) !!}
                </div>
                <div class="pull-left">
                    {!! link_to('/', '一覧へ戻る', ['class' => 'btn btn-info']) !!}
                </div>
            </div>
            <hr style="clear:both;" />
        </section>
    </article>
@endsection
