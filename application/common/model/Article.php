<?php

namespace app\common\model;

use think\Model;

class Article extends Model
{
    protected $table = 'article';

//    public function getStatusAttr($value)
//    {
//        $Status = [1 => '启用', 2 => '禁用'];
//        return $Status[$value];
//    }

    public function getSexAttr($value)
    {
        $sex = [1 => '男', 2 => '女'];
        return $sex[$value];
    }

    public function getTimeAttr($value)
    {
        return date('Y-m-d H:i', $value);
    }
    public function getPhotoAttr($value)
    {
        return '/uploads/'.$value;
    }
}
