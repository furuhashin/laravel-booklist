<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Task List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body style="padding-top:50px;" role="document">
@if(Auth::check())
<!-- 共通ナビゲーション -->
<div class="navbar-fixed-top" role="navigation">
    {{-- ナビゲーションバーの Partial を使用 --}}
    @include('layouts.navbar')
</div>
@endif
<div class="container">
    @yield('content')
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script>
    @yield('script')
</script>
<hr>
<footer class="footer">
    <div class="container">
        <p>Copyright &copy; 2016 Nobukatsu Furuhashi All Rights Reserverd.</p>
    </div>
</footer>
</body>
</html>
