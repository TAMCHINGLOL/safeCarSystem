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
use Think\Controller;

class LoginController extends Controller
{
    protected $subUserModel;
    protected $roleModel;
    protected $adminModel;
    public function __construct()
    {
    	parent::__construct();
        $this->subUserModel = D('User/SubUser');
        $this->roleModel = D('Common/Role');
        $this->adminModel = D('User/Admin');
    }

  	public function index()
  	{
  		$this -> display();
  	}
    public function logOut(){
        session(null);
        $this->display('index');
    }
    public function login(){
        $phone = I('post.phone');
        $username = I('post.username');
        $password = I('post.password');
        if (!empty($phone)) {
            $where['phone'] = $phone;
        }
        if (!empty($username)) {
            $where['uid'] = $username;
        }

        $subUserModel = D('User/Admin');
        $info = $subUserModel->login($where);
        if (empty($info)) {
            $this->error('账号不存在');
            exit;
        }

        if ($info['is_validated'] == 2) {
            $this->error('您已经被禁用,请联系管理员');
            exit;
        }
        if ($info['password'] != md5($password)) {
            $this->error('密码错误');
            exit;
        } else {
//            print_r($info);exit();
            session('sysTag','staff');
            sessionSave($info);
            session('adminUid',$info['uid']);
//            echo session('uid');exit();
            session('password', null);
            $this->success('登录成功');
            exit;
        }
    }
}