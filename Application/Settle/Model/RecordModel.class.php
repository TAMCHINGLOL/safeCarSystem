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
     * 拒绝理赔
     * @param $recordSn
     * @param $isPass
     * @param $remark
     * @return bool
     */
    public function refusePassByRecordSn($recordSn, $isPass, $remark){
        $where['record_sn'] = $recordSn;
        $data = array(
            'is_pass' => $isPass,
            'remark' => $remark,
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
    public function changePassByRecordSn($recordSn, $status, $remark)
    {
        $where['record_sn'] = $recordSn;
        $data['is_pass'] = $status;
        $data['remark'] = $remark;
        return $this->where($where)->save($data);
    }

    /**
     * 修改理赔记录状态
     * @param $recordSn
     * @param $status
     * @return bool
     */
    public function changeStatusByRecordSn($recordSn, $status)
    {
        $where['record_sn'] = $recordSn;
        $data['is_indemnity'] = $status;
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