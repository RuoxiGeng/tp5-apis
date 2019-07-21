<?php
/**
 * Created by PhpStorm.
 * User: ruoxigeng
 * Date: 2019-06-10
 * Time: 22:03
 */
namespace app\common\model;
use think\Db;

class Comment extends Base {
    /**
     * 评论数
     * @param array $param
     * @return int|string
     * @throws \think\Exception
     */
    public function getNormalCommentsCountByCondition($param = []) {
        $count = Db::table('ent_comment')
            ->alias(['ent_comment' => 'a', 'ent_user' => 'b'])
            ->join('ent_user', 'a.user_id = b.id AND a.news_id = '.$param['news_id'])
            ->count();
        return $count;
    }

    /**
     *获取列表数据
     * @param array $param
     * @param int $from
     * @param int $size
     * @return
     */
    public function getNormalCommentsByCondition($param = [], $from = 0, $size = 5) {
        $result = Db::table('ent_comment')
            ->alias(['ent_comment' => 'a', 'ent_user' => 'b'])
            ->join('ent_user', 'a.user_id = b.id AND a.news_id = '.$param['news_id'])
            ->limit($from, $size)
            ->order(['a.id'=>'desc'])
            ->select();
        return $result;
    }

    /**
     * @param array $param
     */
    public function getCountByCondition($param = []) {
        return $this->where($param)
            ->field('id')
            ->count();
    }

    /**
     * @param array $param
     * @param int $from
     * @param int $size
     */
    public function getListsByCondition($param = [], $from = 0, $size = 5) {
        return $this->where($param)
            ->field('*')
            ->limit($from, $size)
            ->order(['a.id'=>'desc'])
            ->select();
    }
}