<?php

namespace app\http\middleware;

use app\admin\model\User;
use think\Controller;
use think\facade\Cookie;

class Guests extends Controller
{
    public function handle($request, \Closure $next)
    {
        $reuslt = User::where('token', Cookie::get('token'))->find();
        if (boolval($reuslt) == true) {
            return $this->error('您已经登入,操作失败', url('article.list'));
        }

        return $next($request);
    }
}
