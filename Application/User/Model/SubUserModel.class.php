<?php
/**
 * @Tool: PhpStorm.
 * @Company:
 * @Author: zml
 * @Since: 2016/11/19 23:01
 * @Description: 描述
 */

namespace User\Model;


use Think\Model;

class SubUserModel extends Model
{
    protected $tableName = 'sub_user';

    /**
     * 根据UID获取该记录
     * @param $uid
     * @return mixed
     */
    public function getRowByUid($uid){
        $where['uid'] = $uid;
        $filed = array('uid','phone','real_name','role_id');
        return $this->field($filed)->where($where)->find();
    }

    /**
     * 根据uid和phone查找记录
     * @param $uid
     * @param $phone
     * @return mixed
     */
    public function getRowByUidPhone($uid, $phone){
        $where['uid'] = $uid;
        $where['phone'] = $phone;
        return $this->where($where)->find();
    }

    /**
     * 获取对应角色的用户列表
     * @param $roleId
     * @param int $isOnline
     * @param int $isValidated
     * @param string $address
     * @return mixed
     */
    public function getUserListBy($roleId, $isOnline = 0, $isValidated = 0,$address = ''){
        if(!empty($isOnline)){
            $where['is_online'] = $isOnline;
        }
        if(!empty($isValidated)){
            $where['is_validated'] = $isValidated;
        }
        if(!empty($address)){
            $where['address'] = array('like','%'.$address.'%');
        }
        if(!empty($roleId)){
            $where['role_id'] = $roleId;
        }
        if(empty($where)){
            return $this->select();
        }else{
            return $this->where($where)->select();
        }
    }

    /**
     * 根据条件(手机号/员工编号)登录
     * @param $where
     * @return mixed
     */
    public function login($where){
        $filed = array('id','uid','password','username','role_id','is_validated','action_list');
        return $this->field($filed)->where($where)->find();
    }
}