<?php

/**
 * @Tool: PhpStorm.
 * @Company:
 * @Author: zml
 * @Since: 2016/11/20 11:43
 * @Description: 描述
 */
namespace Car\Model;
use Think\Model;

class CarMessageModel extends Model
{
    protected $tableName = 'message';

    /**
     * 根据车辆的编号获取该记录
     * @param $carSn
     * @return mixed
     */
    public function getRowByCarSn($carSn){
        $where['car_sn'] = $carSn;
        return $this->where($where)->find();
    }

    /**
     * 根据车辆编号/用户uid联合查询该记录
     * @param $uid
     * @param $carSn
     * @return mixed
     */
    public function getRowByUidCarSn($uid, $carSn){
        $where['uid'] = $uid;
        $where['carSn'] = $carSn;
        return $this->where($where)->find();
    }

    /**
     * 车辆分页加载列表
     * @param $start
     * @param $limit
     * @param array $filter
     * @return mixed|Model
     */
    public function getCarList($start, $limit, $filter = array()){
        if(!empty($filter)){
            return $this->where($filter)->limit($start,$limit)->select();
        }else{
            return $this->limit($start,$limit);
        }
    }
}