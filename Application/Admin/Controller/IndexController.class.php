<?php
/**
 * @Tool: PhpStorm.
 * @Company:
 * @Author: zml
 * @Since: 2016/11/25 14:03
 * @Description: 描述
 */

namespace Admin\Controller;

use Common\Controller\BaseController;
use Common\Controller\CommonController;

class IndexController extends BaseController
{
    protected $subUserModel;
    protected $roleModel;
    protected $adminModel;
    public function __construct()
    {
    	parent::__construct();
        /* $this->subUserModel = D('User/SubUser');
        $this->roleModel = D('Common/Role');
        $this->adminModel = D('User/Admin'); */
    }
    /**
     * 修改密码
     * @Author: ludezh
     */
    public function updatePassword(){
        $oldPwd = I('post.oldPwd');
        $newPwd = I('post.newPwd');
        $adminModel = D('User/Admin');
        $uid = session('uid');
        $rs = $adminModel->findRowByUid($uid);
        if($rs['password'] == md5($oldPwd)){
            if($oldPwd != md5($newPwd)){
                $rs2 = $adminModel->update($uid,md5($newPwd));
                if($rs2){
                    $this->success('修改成功');
                    exit();
                }else{
                    $this->error('修改失败');
                    exit();
                }
            }else{
                $this->error('请输入新密码');
                exit();
            }
        }else{
            $this->error('旧密码错误');
            exit();
        }
    }

    public function index()
    {
    	layout(true);
    	$this -> display('index');
    }
    
   /*  public function policyManage()
    {
    	layout(true);
    	$this -> display('policyManage');
    } */
}