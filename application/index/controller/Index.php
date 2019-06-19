<?php

namespace app\index\controller;

use app\common\model\Article;
use think\Controller;

class Index extends Controller
{
    //首頁
    public function index()
    {
        return view();
    }

    //各地警務
    public function gdjw()
    {
        return view();
    }

    //通緝令列表
    public function articleList($class = '1')
    {
        $type = [1 => 'A级通缉令', 2 => 'B级通缉令', 3 => '专案通缉令'];
        $this->assign('title', $type[$class]);
        $this->assign('list', Article::all(['class' => $class]));
        return view();
    }

    //通緝令詳情
    public function article($class, $id)
    {
        $data = Article::get($id);
        $type = [1 => 'A级通缉令', 2 => 'B级通缉令', 3 => '专案通缉令'];
        $this->assign('title', $type[$class]);
        $this->assign('info', $data);
        return view();
    }
}
