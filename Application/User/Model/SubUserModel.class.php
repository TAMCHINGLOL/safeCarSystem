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
     * 修改员工的禁用状态
     * @param $uid
     * @param $isValidated
     * @return bool
     */
    public function updateValidated($uid, $isValidated){
        $where['uid'] = $uid;
        $data['is_validated'] = $isValidated;
        return $this->where($where)->save($data);
    }

    /**
     * 修改员工
     * @param $uid
     * @return mixed
     */
    public function delRow($uid){
        $where['uid'] = $uid;
        return $this->where($where)->delete();
    }

    /**
     * 修改员工信息
     * @param $staffUid
     * @param $phone
     * @param $realName
     * @param $idCard
     * @param $email
     * @param $roleId
     * @param $auth
     * @param $address
     * @param $parentId
     * @return bool
     */
    public function updateRow($staffUid, $phone, $realName, $idCard, $email, $roleId, $auth, $address, $parentId){
        $where['uid'] = $staffUid;
        $data = array(
            'phone' => $phone,
            'id_card' => $idCard,
            'email' => $email,
            'real_name' => $realName,
            'parent_id' => $parentId,
            'role_id' => $roleId,
            'action_list' => $auth,
            'address' => $address,
        );
        return $this->where($where)->save($data);
    }

    /**
     * 根据uid获取用户信息
     * @param $uid
     * @return mixed
     */
    public function getInfoByUid($uid){
        $where['uid'] = $uid;
        $filed = array(
            'phone',
            'id_card',
            'email',
            'real_name',
            'parent_id',
            'role_id',
            'action_list',
            'address'
        );
        return $this->field($filed)->where($where)->find();
    }

    /**
     * 添加员工uid
     * @param $id
     * @param $uid
     * @return bool
     */
    public function addUid($id, $uid){
        $where['id'] = $id;
        $data['uid'] = $uid;
        return $this->where($where)->save($data);
    }

    /**
     * 新增记录
     * @param $phone
     * @param $realName
     * @param $idCard
     * @param $email
     * @param $roleId
     * @param $actionList
     * @param $address
     * @param $regTime
     * @param $username
     * @param $password
     * @param $parentId
     * @return mixed
     */
    public function addRow($phone, $realName, $idCard, $email, $roleId, $actionList, $address, $regTime, $username, $password, $parentId){
        $data = array(
          'phone' => $phone,
          'username' => $username,
          'password' => $password,
          'id_card' => $idCard,
          'email' => $email,
          'real_name' => $realName,
          'parent_id' => $parentId,
          'reg_time' => $regTime,
          'role_id' => $roleId,
          'action_list' => $actionList,
          'address' => $address,
        );
        return $this->add($data);
    }

    /**
     * 获取所有员工信息
     * @return mixed
     */
    public function getRows(){
        return $this->select();
    }

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