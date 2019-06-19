<?php

namespace app\http\middleware;

use app\admin\model\User;
use think\Controller;
use think\facade\Cookie;

class Auth extends Controller
{
    public function handle($request, \Closure $next)
    {
        $reuslt = User::where('token', Cookie::get('token'))->find();
        if (boolval($reuslt) == false) {
            return $this->error('您尚未登入', url('login'));
        }

        return $next($request);
    }
}
