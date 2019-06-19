<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;

Route::get('api', 'test/Api/send');
Route::get('/', 'index/Index/index');
Route::get('gdjw', 'index/Index/gdjw')->name('gdjw');
Route::group('wstj', function () {
    Route::get('list/:class', 'index/Index/articleList')->name('wstj');
    Route::get('/:class/:id', 'index/Index/article')->name('article');
});
Route::group('cgi-admin', function () {
    Route::get('/', function () {
        return redirect('article.list');
    });
    Route::group('article', function () {
        Route::get('/', 'admin/Article/index')->name('article.list');
        Route::get('create', 'admin/Article/create')->name('article.create');
        Route::get('default', 'admin/Article/defaultCreate')->name('article.default');
        Route::post('save', 'admin/Article/save')->name('article.save');
        Route::get('edit/:id', 'admin/Article/edit')->name('article.edit');
        Route::post('edit/:id', 'admin/Article/update')->name('article.update');
        Route::get('delete/:id', 'admin/Article/delete')->name('article.delete');
    });
    Route::group('user', function () {
        Route::get('/', 'admin/User/index')->name('user.list');
        Route::get('create', 'admin/User/create')->name('user.create');
        Route::post('create', 'admin/User/postCreate')->name('user.create.post');
        Route::get('logout', 'admin/User/logout')->name('user.logout');
    });
})->middleware('Auth');
Route::get('cgi-login', 'admin/User/login')->name('login')->middleware('Guests');
Route::post('cgi-login', 'admin/User/postLogin')->name('login.post')->middleware('Guests');
return [

];
