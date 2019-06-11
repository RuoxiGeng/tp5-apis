<?php
namespace app\admin\controller;

use think\Controller;

class News extends Base
{
    public function index() {
        //模式一
//        $news = model('News')->getNews();
        //模式二
        $data = input('param.');
        $query = http_build_query($data);
        $whereData = [];

        // 转换查询条件
        if(!empty($data['start_time']) && !empty($data['end_time'])
            && $data['end_time'] > $data['start_time']
        ) {
            $whereData['create_time'] = [
                ['gt', strtotime($data['start_time'])],
                ['lt', strtotime($data['end_time'])],
            ];
        }
        if(!empty($data['catid'])) {
            $whereData['catid'] = intval($data['catid']);
        }
        if(!empty($data['title'])) {
            $whereData['title'] = ['like', '%'.$data['title'].'%'];
        }

        $this->getPageAndSize($data);
//        $whereData['page'] = $this->page;
//        $whereData['size'] = $this->size;

        $news = model('News')->getNewsByCondition($whereData, $this->from, $this->size);
        //获取满足提哦啊间的数据总数有多少页
        $total = model('News')->getNewsCountByCondition($whereData);
        $pageTotal = ceil($total/$this->size);
        return $this->fetch('', [
            'cats' => config('cat.lists'),
            'news' => $news,
            'pageTotal' => $pageTotal,
            'curr' => $this->page,
            'start_time' => empty($data['start_time']) ? '' : $data['start_time'],
            'end_time' => empty($data['end_time']) ? '' : $data['end_time'],
            'catid' => empty($data['catid']) ? '' : $data['catid'],
            'title' => empty($data['title']) ? '' : $data['title'],
            'query' => $query,
        ]);
    }

    public function add() {
        if(request()->isPost()) {
            $data = input('post.');
            // 数据需要做检验 validate机制小伙伴自行完成

            //入库操作
            try {
                $id = model('News')->add($data);
            } catch (\Exception $e) {
                return $this->result('', 0, '新增失败');
            }
            if($id) {
                return $this->result(['jump_url' => url('news/index')], 1, 'OK');
            } else {
                return $this->result('', 0, '新增失败');
            }
        } else {
            return $this->fetch('', [
                'cats' => config('cat.lists')
            ]);
        }
    }
}
