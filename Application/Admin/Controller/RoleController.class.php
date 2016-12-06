<?php
/**
 * @Tool: PhpStorm.
 * @Company:
 * @Author: zml
 * @Since: 2016/11/25 10:23
 * @Description: 描述角色管理(包括员工管理/权限管理)
 */

namespace Admin\Controller;


use Common\Controller\CommonController;

class RoleController extends CommonController
{
    protected $roleModel;

    public function __construct()
    {
    	parent::__construct();
    	layout(true);
        $this->roleModel = D('Common/Role');
    }

    /**
     *加载角色管理页面
     */
    public function findRole(){
        $roleList = $this->roleModel->getRows();
        $this->assign('roleList',$roleList);
        $this->display();
    }

    /**
     *添加角色
     */
    public function addRole(){
        $name = I('post.name');
        $remark = I('post.remark');
        $auth = I('post.auth');     //权限
        $rs = $this->roleModel->addRow($name,$auth,$remark);
        if($rs){
            $this->success('添 加 成 功');
            exit();
        }else{
            $this->error('添加失败');
            exit();
        }
    }

    /**
     *删除角色
     */
    public function delRole(){
        $roleId = I('post.roleId');
        $rs = $this->roleModel->delRow($roleId);
        if($rs){
            $this->success('删 除 成 功');
            exit();
        }else{
            $this->error('删除失败');
            exit();
        }
    }

    /**
     *更新角色
     */
    public function updateRole(){
        $roleId = I('post.roleId');
        $name = I('post.name');
        $auth = I('post.auth');
        $remark = I('post.remark');
        $rs = $this->roleModel->updateRow($roleId,$name,$auth,$remark);
        if($rs){
            $this->success('更 新 成 功');
            exit();
        }else{
            $this->error('更新失败');
            exit();
        }
    }
}