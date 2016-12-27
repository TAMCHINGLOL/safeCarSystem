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
     * @param $inspectSn
     * @param $status
     * @return bool
     * @Author: ludezh
     */
    public function updateStatusBySn($inspectSn, $status){
        $where['inspect_sn'] = $inspectSn;
        $data['status'] = intval($status);
        return $this->where($where)->save($data);
    }

    /**
     * @param $inspectSn
     * @param $status
     * @param $financeUid
     * @return bool
     * @Author: ludezh
     */
    public function updateRowStatusAndFinance($inspectSn, $status, $financeUid){
        $where['inspect_sn'] = $inspectSn;
        $data['finance_uid'] = $financeUid;
        $data['status'] = $status;
        return $this->where($where)->save($data);
    }
    /**
     * @param $status
     * @return mixed
     * @Author: ludezh
     */
    public function getAllInspect($status){
        $where['status'] = $status;
        return $this->where($where)->select();
    }
    /**
     * @param $inspectSn
     * @param $inspectUid
     * @return mixed
     * @Author: ludezh
     */
    public function getInspectInfoByInspectSn($inspectSn, $inspectUid){
        if(!empty($inspectUid)){
            $where['inspect_uid'] = $inspectUid;
        }
        $where['inspect_sn'] = $inspectSn;
        return $this->where($where)->find();
    }
    /**
     * @param $uid
     * @param int $status
     * @return mixed
     * @Author: ludezh
     */
    public function getListByInspectUid($uid, $status = 0){
        if(!empty($status)){
            $where['status'] = $status;
        }
        $where['inspect_uid'] = $uid;
        return $this->where($where)->select();
    }

    /**
     * @param $inspectSn
     * @param $inspectUid
     * @param $status
     * @return bool
     * @Author: ludezh
     */
    public function updateInspectInfo($inspectSn, $inspectUid,$status){
        $where['inspect_sn'] = $inspectSn;
        $data['inspect_uid'] = $inspectUid;
        $data['status'] = $status;
        return $this->where($where)->save($data);
    }
    /**
     * 根据主管uid和状态获取对应的理赔记录列表
     * @param $uid
     * @param $status
     * @return mixed
     */
    public function getRowsByDealerUid($uid, $status){
        $where['dealer_uid'] = $uid;
        $where['status'] = $status;
        return $this->where($where)->select();
    }

    /**
     * 修改审核通过状态(用于主管的二级审核不通过)
     * @param $inspectSn
     * @param $dealerUid
     * @param $status
     * @param $remark
     * @return bool
     */
    public function changeStatusByDealer($inspectSn, $dealerUid, $status, $remark){
        $where['inspect_sn'] = $inspectSn;
        $data['status'] = $status;
        $data['remark'] = $remark;
        $data['dealer_uid'] = $dealerUid;
        return $this->where($where)->save($data);
    }

    /**
     * 修改审核通过状态(用于财务的初级审核)
     * @param $inspectSn
     * @param $status
     * @param $remark
     * @param $financeUid
     * @return bool
     */
    public function changePassStatus($inspectSn, $status, $remark = '', $financeUid){
        $where['inspect_sn'] = $inspectSn;
        $data['status'] = $status;
        $data['remark'] = $remark;
        $data['finance_uid'] = $financeUid;
        return $this->where($where)->save($data);
    }

    /**
     * 财务人员根据状态获取理赔登记记录列表
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
     * 改变理赔登记表状态和接单时间(勘察人员专属)
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
     * @param $status
     * @param $uid
     * @return mixed
     * @Author: ludezh
     */
    public function getInspectListByInspect($status, $uid){
        if(!empty($status)){
            $where['status'] = $status;
        }
        $where['inspect_uid'] = $uid;
        return $this->where($where)->select();
    }

    /**
     * @param $status
     * @param $uid
     * @return mixed
     * @Author: ludezh
     */
    public function getInspectListByCustom($status, $uid){
        if(!empty($status)){
            $where['status'] = $status;
        }
        $where['custom_uid'] = $uid;
        return $this->where($where)->select();
    }

    /**
     * 根据状态获取对应勘察人员的理赔登记记录
     * @param $status
     * @param $uid
     * @return mixed
     */
    public function getInspectList($status,$uid){
        if(empty($status)){
            $where['status'] = $status;
        }
        $where['inspect_uid'] = $uid;
        return $this->where($where)->select();
    }

    /**
     * 勘察登记表绑定调度人员Uid
     * @param $uid
     * @param $inspectSn
     * @param $status
     * @return bool
     */
    public function bindInspectUid($uid,$inspectSn,$status = 8){
        $where['inspect_sn'] = $inspectSn;
        $data['inspect_uid'] = $uid;
        $data['status'] = $status;
        return $this->where($where)->save($data);
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