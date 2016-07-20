<!DOCTYPE HTML>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Task List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body style="padding-top:50px;" role="document">
<!-- 共通ナビゲーション -->
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">Nob Tasks</a>
        </div>
    </div>
</div>
<div class="container">
    @yield('content')
</div>
<hr>
<footer class="footer">
    <div class="container">
        <p>Copyright &copy; 2016 Furuhashi All Rights Reserverd.</p>
    </div>
</footer>
</body>
</html>
