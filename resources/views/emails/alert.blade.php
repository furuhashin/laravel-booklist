<p>
    こんにちは{{ $user->name }}さん
</p>
<p>
    {{ $user->name }}さんが借りている以下の書籍について貸出期限が過ぎていますので、返却をお願いします。
</p>
    @foreach($books as $book)
    <p>・{{ $book->title }}:{{$book->deadline}}まで</p>
    @endforeach
<p>
    <a href="{{ ('http://laravel-tasklist/auth/login') }}">こちらからアクセス出来ます</a>
</p>
