<?php

/**
 * @Tool: PhpStorm.
 * @Company:
 * @Author: zml
 * @Since: 2016/11/20 16:19
 * @Description: 描述
 */
namespace Settle\Model;

use Think\Model;

class RecordModel extends Model
{
    protected $tableName = 'settle_record';

    /**
     * @param $id
     * @param $recordSn
     * @return bool
     * @Author: ludezh
     */
    public function addRecordSn($id, $recordSn){
        $where['id'] = $id;
        $data['record_sn'] = $recordSn;
        return $this->where($where)->save($data);
    }
    /**
     * 获取等待审核的理赔报价单列表
     * @return mixed
     */
    public function getRowsWaiting(){
        $where['is_pass'] = 1;
        return $this->where($where)->select();
    }
    /**
     * 获取单条理赔
     */
    public function getRows($id)
    {
        return $this->find($id);
    }

    /**
     * 根据主管uid获取审核不通过/审核通过的记录
     * @param $uid
     * @param $status
     * @return mixed
     */
    public function getRowsByDealerUid($uid, $status){
        $where['dealer_uid'] = $uid;
        $where['is_pass'] = $status;
        return $this->where($where)->select();
    }

    /**
     * 二级审核不通过删除原先的理赔报价单
     * @param $inspectSn
     * @param $recordSn
     * @return mixed
     */
    public function deleteOldRecordByInspectSnRecordSn($inspectSn,$recordSn){
        $where['inspect_sn'] = $inspectSn;
        $where['record_sn'] = $recordSn;
        return $this->where($where)->delete();
    }

    /**
     * 根据财务uid和订单状态获取理赔记录列表
     * @param $financeUid
     * @param $status
     * @return mixed
     */
    public function getListByStatus($financeUid, $status){
        $where['finance_uid'] = $financeUid;
        $where['is_pass'] = $status;
        return $this->where($where)->select();
    }

    /**
     * 拒绝理赔
     * @param $recordSn
     * @param $dealerUid
     * @param $isPass
     * @param $remark
     * @return bool
     */
    public function refusePassByRecordSn($recordSn, $dealerUid, $isPass, $remark){
        $where['record_sn'] = $recordSn;
        $data = array(
            'is_pass' => $isPass,
            'remark' => $remark,
            'dealer_uid' => $dealerUid
        );
        return $this->where($where)->save($data);
    }

    /**
     * 修改审核状态
     * @param $recordSn
     * @param $status
     * @param $remark
     * @return bool
     */
    public function changePassByRecordSn($recordSn, $status, $remark = '')
    {
        if(!empty($remark)){
            $data['remark'] = $remark;
        }
        $where['record_sn'] = $recordSn;
        $data['is_pass'] = $status;
        return $this->where($where)->save($data);
    }

    /**
     * 根据id添加Record_sn
     * @param $id
     * @param $record_sn
     * @return bool
     */
    public function addRecordSnById($id, $record_sn)
    {
        $where['id'] = $id;
        $data['record_sn'] = $record_sn;
        return $this->where($where)->save($data);
    }

    /**
     * 新增一条新的理赔记录
     * @param $uid
     * @param $financeUid
     * @param $inspect_sn
     * @param $car_sn
     * @param $policy_sn
     * @param $type_sn
     * @param $add_time
     * @param $address
     * @param $create_time
     * @param $amount
     * @param $remark
     * @return mixed
     */
    public function addNewRow($uid, $financeUid, $inspect_sn, $car_sn, $policy_sn, $type_sn, $add_time, $address, $create_time, $amount, $remark)
    {
        $data = array(
            'uid' => $uid,
            'finance_uid' => $financeUid,
            'inspect_sn' => $inspect_sn,
            'car_sn' => $car_sn,
            'policy_sn' => $policy_sn,
            'type_sn' => $type_sn,
            'add_time' => $add_time,
            'address' => $address,
            'create_time' => $create_time,
            'amount' => $amount,
            'remark' => $remark,
        );
        return $this->add($data);
    }

}