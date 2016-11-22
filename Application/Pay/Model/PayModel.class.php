<?php

/**
 * @Tool: PhpStorm.
 * @Company:
 * @Author: zml
 * @Since: 2016/11/20 16:19
 * @Description: 描述
 */
namespace Pay\Model;

use Think\Model;

class PayModel extends Model
{
    /**
     * @var string
     */
    protected $tableName = 'settle_pay';

    /**
     * 根据id添加paySn支付编号
     * @param $id
     * @param $paySn
     * @return bool
     */
    public function addPaySnById($id, $paySn){
        $where['id'] = $id;
        $data['pay_sn'] = $paySn;
        return $this->where($where)->save($data);
    }

    /**
     * 新增一条支付记录
     * @param $carUid
     * @param $dealUid
     * @param $financeUid
     * @param $recordSn
     * @param $payCode
     * @param $price
     * @param $createTime
     * @param $remark
     * @return mixed
     */
    public function addNewRow($carUid, $dealUid, $financeUid, $recordSn, $payType, $price, $createTime, $remark){
        $data = array(
            'uid' => $carUid,
            'dealer_uid' => $dealUid,
            'finance_uid' => $financeUid,
            'record_sn' => $recordSn,
            'pay_type' => $payType,
            'price' => $price,
            'create_time' => $createTime,
            'remark' => $remark,
        );
        return $this->add($data);
    }

    /**
     * 修改支付状态和支付方式
     * @param $paySn
     * @param $status
     * @param $payType
     * @return bool
     */
    public function changeStatusByPaySn($paySn, $status, $payType){
        $where['pay_sn'] = $paySn;
        $data['is_pay'] = $status;
        $data['pay_type'] = $payType;
        return $this->where($where)->save($data);
    }

    /**
     * 财务人员根据状态获取对应列表
     * @param $uid
     * @param $status
     * @return mixed
     */
    public function getListByFinanceUid($uid, $status){
        $where['finance_uid'] = $uid;
        $where['is_pay'] = $status;
        return $this->where($where)->select();
    }
}