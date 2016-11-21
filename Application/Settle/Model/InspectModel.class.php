<?php
/**
 * @Tool: PhpStorm.
 * @Company:
 * @Author: zml
 * @Since: 2016/11/20 13:48
 * @Description: 描述
 */

namespace Settle\Model;


use Think\Model;

class InspectModel extends Model
{
    /**
     * @var string
     */
    protected $tableName = 'settle_inspect';

    /**
     * 根据状态获取理赔登记记录列表
     * @param $status
     * @return mixed
     */
    public function findInspectList($status){
        $where['status'] = $status;
        return $this->where($where)->select();
    }

    /**
     * 完成最后的理赔登记记录
     * @param $inspectSn
     * @param $status
     * @param $headList
     * @param $bodyList
     * @param $footerList
     * @param $otherList
     * @param $baseImg
     * @param $remark
     * @param $endTime
     * @return bool
     */
    public function completeUpdate($inspectSn, $status, $headList, $bodyList, $footerList, $otherList, $baseImg, $remark, $endTime)
    {
        $where['inspect_sn'] = $inspectSn;
        $data = array(
            'header_img_list' => $headList,
            'body_img_list' => $bodyList,
            'footer_img_list' => $footerList,
            'other_img_list' => $otherList,
            'base_img' => $baseImg,
            'inspect_remark' => $remark,
            'end_time' => $endTime,
            'status' => $status,
        );
        return $this->where($where)->save($data);
    }

    /**
     * 改变理赔登记表状态和接单时间
     * @param $uid
     * @param $inspectSn
     * @param $status
     * @param $startTime
     * @return bool
     */
    public function changeStatus($uid, $inspectSn, $status,$startTime){
        $where['inspect_uid'] = $uid;
        $where['inspect_sn'] = $inspectSn;
        $data['status'] = $status;
        $data['start_time'] = $startTime;
        return $this->where($where)->save($data);
    }

    /**
     * 根据勘察登记表编号获取该记录
     * @param $inspectSn
     * @return mixed
     */
    public function getRowByInspectSn($inspectSn){
        $where['inspect_sn'] = $inspectSn;
        return $this->where($where)->find();
    }

    /**
     * 根据状态获取对应勘察人员的理赔登记记录
     * @param $status
     * @param $uid
     * @return mixed
     */
    public function getInspectList($status,$uid){
        $where['status'] = $status;
        $where['inspect_uid'] = $uid;
        return $this->where($where)->select();
    }

    /**
     * 勘察登记表绑定调度人员Uid
     * @param $uid
     * @param $inspectSn
     * @return bool
     */
    public function bindInspectUid($uid,$inspectSn){
        $where['inspect_sn'] = $inspectSn;
        $data['inspect_uid'] = $uid;
        return $this->where($inspectSn)->save($data);
    }

    /**
     * 新增系统编号
     * @param $id
     * @param $inspectSn
     * @return bool
     */
    public function addInspectSnById($id, $inspectSn){
        $where['id'] = $id;
        $data['inspect_sn'] = $inspectSn;
        return $this->where($where)->save($data);
    }

    /**
     * 新增勘察信息
     * @param $carUid
     * @param $carSn
     * @param $policySn
     * @param $typeSn
     * @param $address
     * @param $remark
     * @param $customUid
     * @param $happenTime
     * @return mixed
     */
    public function addRow($carUid, $carSn, $policySn, $typeSn, $address, $remark, $customUid, $happenTime){
        $data = array(
            'uid' => $carUid,
            'car_sn' => $carSn,
            'policy_sn' => $policySn,
            'type_sn' => $typeSn,
            'address' => $address,
            'custom_uid' => $customUid,
            'custom_remark' => $remark,
            'happen_time' => $happenTime,
        );
        return $this->add($data);
    }
}