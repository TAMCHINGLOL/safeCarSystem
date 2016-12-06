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
    protected $actionModel;

    public function __construct()
    {
    	parent::__construct();
    	layout(true);
        $this->roleModel = D('Common/Role');
        $this->actionModel = D('Common/Action');
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
     *编辑角色权限页面
     */
    public function editRole(){
        $id = $_GET['id'];
        $role = $this->roleModel-> where("id='".$id."'") -> find();
        $actions = explode(',', $role['auth_list']);
        foreach ($actions as $k => $v) {
            $act[] = $this -> actionModel -> where("id='".$v['id']."'") -> find();
        }
        $allAct = $this -> actionModel -> select();
        foreach ($allAct as $k => $v) {
            $allAct[$k]['select'] = 0;
            foreach ($actions as $vv){
                if($v['id'] == $vv[id]) {
                    $allAct[$k]['select'] = 1;
                    break;
                }
            }
            
        }
        $this -> assign('allAct', $allAct);
        $this->assign('role',$role);
        $this->display();
    }
    
    /**
     * 保存角色编辑
     */
    public function edit_post(){
        $role = M('Role');
        $data['id'] = intval($_POST['role_id']);
        unset($_POST['role_id']);
        $data['auth_list'] = implode(',', $_POST);
        $result = $role ->  save($data);
        if($result) {
            $this->success('保存成功', '/admin/role/findRole');
            
        } else {
            $this->error('保存失败', '/admin/role/findRole');
        }
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
        $roleId = I('get.id');
        $rs = $this->roleModel->delRow($roleId);
        if($rs){
            $this->success('删 除 成 功');
            exit();
        }else{
            //$this->error('删除失败');
            exit();
        }
    }
    
    /**
     * 更新角色页面
     */
    public function updateRole()
    {
        $id = $_GET['id'];
        $data = $this -> roleModel -> where("id='".$id."'") -> find();
        $this -> assign('data', $data);
        $this -> display();
    }
    /**
     *更新角色
     */
    public function updateRole_post(){
        $data['id'] = intval(I('post.role_id'));
        $data['role_name'] = I('post.role_name');
        $data['remark'] = I('post.remark');
        $rs = $this->roleModel->save($data);
        echo $this -> roleModel ->getLastSql();
        if($rs){
            $this->success('更 新 成 功');
            exit();
        }else{
            $this->error('更新失败');
            exit();
        }
    }
}