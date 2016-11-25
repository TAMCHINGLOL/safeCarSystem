<?php

/**
 * @Tool: PhpStorm.
 * @Company:
 * @Author: zml
 * @Since: 2016/11/20 16:18
 * @Description: 描述
 */
namespace Common\Model;

use Think\Model;

class RoleModel extends Model
{
    protected $tableName = 'role';

    public function getAuthByRoleId($roleId){
        $where['id'] = $roleId;
        return $this->where($where)->getField('auth_list');
    }
    public function getRows()
    {
        return $this->select();
    }

    public function addRow($name, $auth, $remark)
    {
        $data['role_name'] = $name;
        $data['auth_list'] = $auth;
        $data['remark'] = $remark;
        return $this->add($data);
    }

    public function delRow($roleId)
    {
        $where['id'] = $roleId;
        return $this->where($where)->delete();
    }

    public function updateRow($roleId,$name,$auth,$remark)
    {
        $where['id'] = $roleId;
        $data['role_name'] = $name;
        $data['auth_list'] = $auth;
        $data['remark'] = $remark;
        return $this->where($where)->save($data);
    }
}