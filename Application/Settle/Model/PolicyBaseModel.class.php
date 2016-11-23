<?php
/**
 * @Tool: PhpStorm.
 * @Company:
 * @Author: zml
 * @Since: 2016/11/20 13:39
 * @Description: 描述
 */

namespace Settle\Model;


use Think\Model;

class PolicyBaseModel extends Model
{
    protected  $tableName = 'policy_base';

    /**
     * 获取所有基本保单
     * @return mixed
     */
    public function getRows(){
        return $this->select();
    }

    /**
     * 根据uid/car_sn获取基本保单记录
     * @param $uid
     * @param $carSn
     * @return mixed
     */
    public function getRowByUidCarSn($uid, $carSn){
        $where['uid'] = $uid;
        $where['car_sn'] = $carSn;
        return $this->where($where)->find();
    }
}