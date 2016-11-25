<?php
/**
 * @Tool: PhpStorm.
 * @Company:
 * @Author: zml
 * @Since: 2016/11/25 14:03
 * @Description: 描述
 */

namespace Admin\Controller;


use Common\Controller\CommonController;

class StaffController extends CommonController
{
    protected $subUserModel;
    protected $roleModel;
    protected $adminModel;
    public function __construct()
    {
        $this->subUserModel = D('User/SubUser');
        $this->roleModel = D('Common/Role');
        $this->adminModel = D('User/Admin');
    }

    /**
     *获取员工列表并加载页面
     */
    public function staffList(){
        $staffList = $this->subUserModel->getRows();
        $this->assign('staffList',$staffList);
        $this->display();
    }

    /**
     *加载添加员工页面
     */
    public function loadAddStaff(){
        $roleList = $this->roleModel->getRows();
        $this->assign('roleList',$roleList);
        $this->display();
    }

    /**
     *添加新员工
     */
    public function addStaff(){
        $phone = I('post.phone');
        $realName = I('post.realName');
        $idCard = I('post.idCard');
        $email = I('post.email');
        $roleId = I('post.roleId');
        $auth = $this->roleModel->getAuthByRoleId($roleId);
        $address = I('post.address');
        $regTime = date('Y-m-d H:i:s');
        $username = getRandStr(10);
        $pwdStr = substr($idCard,-6);
        $password = md5(md5($pwdStr));  //身份证后6位
        $uid = session('uid');
        $parentId = $this->adminModel->getIdByUid($uid);
        $id = $this->subUserModel->addRow($phone,$realName,$idCard,$email,$roleId,$auth,$address,$regTime,$username,$password,$parentId);
        $staffUid = makeEveryNumber('UC',$id);
        $rs = $this->subUserModel->addUid($id,$staffUid);
        if($rs){
            $this->success('添 加 成 功');
            exit();
        }else{
            $this->error('添加失败');
            exit();
        }
    }

    /**
     *加载编辑员工页面
     */
    public function loadUpdateStaff(){
        $uid = I('post.uid');
        $userInfo = $this->subUserModel->getInfoByUid($uid);
        $this->assign('userInfo',$userInfo);
        $this->display();
    }

    /**
     *修改员工信息
     */
    public function updateStaff(){
        $staffUid = I('post.uid');
        $phone = I('post.phone');
        $realName = I('post.realName');
        $idCard = I('post.idCard');
        $email = I('post.email');
        $roleId = I('post.roleId');
        $auth = $this->roleModel->getAuthByRoleId($roleId);
        $address = I('post.address');
//        $pwdStr = substr($idCard,-6);
//        $password = md5(md5($pwdStr));  //身份证后6位
        $uid = session('uid');
        $parentId = $this->adminModel->getIdByUid($uid);
        $rs = $this->subUserModel->updateRow($staffUid,$phone,$realName,$idCard,$email,$roleId,$auth,$address,$parentId);
        if($rs){
            $this->success('修 改 成 功');
            exit();
        }else{
            $this->error('修改失败');
            exit();
        }
    }

    /**
     *删除员工
     */
    public function delStaff(){
        $uid = I('post.uid');
        $rs = $this->subUserModel->delRow($uid);
        if($rs){
            $this->success('删 除 成 功');
            exit();
        }else{
            $this->error('删除失败');
            exit();
        }
    }

    /**
     *修改员工状态
     */
    public function isValidated(){
        $uid = I('post.uid');
        $isValidated = I('post.isValidated');
        $rs = $this->subUserModel->updateValidated($uid,$isValidated);
        if($rs){
            $this->success('成 功 禁 用');
            exit();
        }else{
            $this->error('禁用失败');
            exit();
        }
    }
}