<?php
/**
 * @Tool: PhpStorm.
 * @Company:
 * @Author: zml
 * @Since: 2016/11/20 16:21
 * @Description: 描述
 */

namespace User\Model;


use Think\Model;

class UserModel extends Model
{
    protected $tableName = 'user';

    /**
     * 根据uid获取用户信息
     * @param $uid
     * @return mixed
     */
    public function getRowByUid($uid)
    {
        $filed = array('uid','username','phone','header','sex');
        $where['uid'] = $uid;
        return $this->field($filed)->where($where)->find();
    }
}