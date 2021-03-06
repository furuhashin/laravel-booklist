<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class RedirectIfAuthenticated
{
    /**
     * Guardの実装
     *
     * @var Guard
     */
    protected $auth;

    /**
     * 新しいフィルターインスタンス
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * 送られてきたリクエストの処理
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->check()) {
            //認証後にログイン画面に行こうとしてもindexにリダイレクトされる
            return redirect('/');
        }

        return $next($request);
    }
}
