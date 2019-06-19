<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Request;

class Article extends Controller
{
    public function index()
    {
        $this->assign('data', \app\common\model\Article::all(['class' => '3']));
        return view();
    }

    public function create()
    {
        return view();
    }

    public function save(Request $request)
    {
        function upload()
        {
            $file = request()->file('image');
            $info = $file->move('../public/uploads');
            if ($info) {
                return $info->getSaveName();
            } else {
                return $file->getError();
            }
        }

        $image = upload();
        $data = input('post.');
        $data['photo'] = $image;
        $data['time'] = time();
        \app\common\model\Article::create($data);
        return $this->success('添加成功');
    }

    public function defaultCreate()
    {
        \app\common\model\Article::destroy(function ($query) {
            $query->where('class', '<', '3');
        });
        $data = Db::table('default')->where('ttype', '<', '3')->select();
        $sex = ['男' => 1, '女' => 2];
        foreach ($data as $value) {
            \app\common\model\Article::create([
                'class' => $value['ttype'],
                'name' => $value['name'],
                'sex' => $sex[$value['sex']],
                'birthday' => $value['csrq'],
                'idNum' => $value['sfzh'],
                'wantedNum' => $value['tjbh'],
                'confidentiality' => $value['bmjb'],
                'briefCase' => $value['jyaq'],
                'remarks' => $value['bz'],
                'photo' => $value['path'],
            ]);
        }
        return $this->success('添加成功', url('article.list'));
    }

    public function edit($id)
    {
        $this->assign('data', \app\common\model\Article::get($id));
        return view();
    }

    public function update(Request $request, $id)
    {
        $data = input('post.');
        function upload()
        {
            $file = request()->file('image');
            $info = $file->move('../public/uploads');
            if ($info) {
                return $info->getSaveName();
            } else {
                return $file->getError();
            }
        }

        if (empty($_FILES['image']['tmp_name']) == false) {
            $image = upload();
            $data['photo'] = $image;
        }
        $model = new \app\common\model\Article();
        $model->save($data,['id'=>$id]);
        return $this->success('更新成功');
    }

    /**
     * 删除指定资源
     *
     * @param  int $id
     * @return \think\Response
     */
    public function delete($id)
    {
        \app\common\model\Article::destroy($id);
        return $this->success('数据删除成功');
    }
}
