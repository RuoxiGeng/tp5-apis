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
use think\Route;

//get
Route::get('test', 'api/test/index');
Route::put('test/:id', 'api/test/update');
Route::delete('test/:id', 'api/test/delete');

Route::resource('test', 'api/test');
//post => api/test save

Route::get('api/:ver/cat', 'api/:ver.cat/read');
Route::get('api/:ver/index', 'api/:ver.index/index');

//news
Route::resource('api/:ver/news', 'api/:ver.news');
//rank
Route::get('api/:ver/rank', 'api/:ver.rank/index');

