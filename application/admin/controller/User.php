<?php

namespace app\admin\controller;

use think\Controller;
use think\facade\Cookie;
use think\Request;

class User extends Controller
{
    public function index()
    {
        return view();
    }

    public function login()
    {
        return view();
    }

    public function postLogin()
    {
        $result = \app\admin\model\User::get(input('post.'));
        if (boolval($result) == false) {
            return $this->error('管理员不存在');
        }
        Cookie::set('token', $result['token'], 3600);
        return $this->success('登入成功', url('article.list'));
    }

    public function create()
    {
        return view();
    }

    public function postCreate()
    {
        $data = input('post.');
        $reuslt = \app\admin\model\User::get(['username' => $data['username']]);
        if (boolval($reuslt) == true) {
            return $this->error($data['username'] . '已存在,无法创建');
        }
        $data['token'] = hash_hmac('sha256', $data['username'] . time(), $data['password']);
        \app\admin\model\User::create($data);
        return $this->success('创建成功');
    }

    public function logout($username)
    {
        $result = \app\admin\model\User::get([
            'username' => $username,
            'token' => Cookie::get('token'),
        ]);
        if (boolval($result) == false) {
            return $this->error('操作失败,请重新操作');
        }
        Cookie::delete('token');
        return $this->success('登出成功');
    }
}
