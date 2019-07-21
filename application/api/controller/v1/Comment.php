<?php
/**
 * Created by PhpStorm.
 * User: ruoxigeng
 * Date: 2019-06-12
 * Time: 23:10
 */
namespace app\api\controller\v1;

use app\common\lib\exception\ApiException;

class Comment extends AuthBase {

    /**
     * 评论回复功能开发
     */
    public function save() {
        $data = input('post.', []);
        //validate
        $data['user_id'] = $this->user->id;

        try {
            $commentId = model('Comment')->add($data);
            if($commentId) {
                return show(config('code.success'), 'OK', [], 202);
            } else {
                return show(config('code.error'), '评论失败', [], 500);
            }
        }catch (\Exception $e) {

        }
    }

    /**
     * 评论列表 v1.0使用关联查询
     */
    /*public function read() {
        $newsId = input('param.id', 0, 'intval');
        if(empty($newsId)) {
            return new ApiException('id is not ', 404);
        }

        $param['news_id'] = $newsId;
        $count = model('Comment')->getNormalCommentsCountByCondition($param);

        $this->getPageAndSize(input('param.'));
        $comments = model('Comment')->getNormalCommentsByCondition($param, $this->from, $this->size);

        $result = [
            'total' => $count,
            'page_num' => ceil($count / $this->size),
            'list' => $comments,
        ];

        return show(config('code.success'), 'OK', $result, 200);
    }*/

    /**
     * v2.0 优化查询 先查询出id 再用sql in
     * @return ApiException|mixed
     */
    public function read() {
        $newsId = input('param.id', 0, 'intval');
        if(empty($newsId)) {
            return new ApiException('id is not ', 404);
        }

        $param['news_id'] = $newsId;
        $count = model('Comment')->getCountByCondition($param);

        $this->getPageAndSize(input('param.'));
        $comments = model('Comment')->getListsByCondition($param, $this->from, $this->size);

        if($comments) {
            foreach ($comments as $comment) {
                $userIds[] = $comment['user_id'];
                if($comment['to_user_id']) {
                    $userIds[] = $comment['to_user_id'];
                }
            }
            $userIds = array_unique($userIds);
        }
        $userIds = model('User')->getUsersByUserId($userIds);

        if(empty($userIds)) {
            $userIdNames = [];
        } else {
            foreach ($userIds as $userId) {
                $userIdNames[$userId->id] = $userId;
            }
        }

        $resultDatas = [];
        foreach($comments as $comment)  {
            $resultDatas[] = [
                'id' => $comment->id,
                'user_id' => $comment->user_id,
                'to_user_id' => $comment->to_user_id,
                'content' => $comment->content,
                'username' => !empty($userIdNames[$comment->user_id]) ? $userIdNames[$comment->user_id]->username : '',
                'tousername' => !empty($userIdNames[$comment->to_user_id]) ? $userIdNames[$comment->to_user_id]->username : '',
                'parent_id' => $comment->parent_id,
                'create_time' => $comment->create_time,
                'image' => !empty($userIdNames[$comment->user_id]) ? $userIdNames[$comment->user_id]->image : '',
            ];
        }

        $result = [
            'total' => $count,
            'page_num' => ceil($count / $this->size),
            'list' => $resultDatas,
        ];

        return show(config('code.success'), 'OK', $result, 200);
    }
}