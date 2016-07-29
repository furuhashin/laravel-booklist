<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <!-- スマホやタブレットで表示した時のメニューボタン -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- ブランド表示 -->
            <a class="navbar-brand" href="/">Nob Books</a>
        </div>

        <!-- メニュー -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <!-- 左寄せメニュー -->
            <ul class="nav navbar-nav">
                <li><a href="">About</a></li>
                <li class="search navbar-form">
                    {!! Form::open(['method' => 'get','url' => "books",'files' => true]) !!}
                {!! Form::input('search','keyword',null,['placeholder' => "タイトルで検索"]) !!}
                {!! Form::submit('Search', array('class' => 'btn btn-primary')) !!}
                {!! Form::close() !!}
                </li>
            </ul>

            <!-- 右寄せメニュー -->
            <ul class="nav navbar-nav navbar-right">
                <li class="btn btn-info">
                    {!! link_to('books/create','書籍情報の新規作成') !!}
                </li>
                <!-- ドロップダウンメニュー -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">ようこそ{{Auth::user()->name}}さん<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Profile</a></li>
                        <li class="divider"></li>
                        <li><a href="/auth/logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>