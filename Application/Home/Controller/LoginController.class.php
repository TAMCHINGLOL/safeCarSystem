<?php
/**
 * @Tool: PhpStorm.
 * @Company:
 * @Author: zml
 * @Since: 2016/11/19 22:55
 * @Description: 描述
 */

namespace Home\Controller;


use Think\Controller;

class LoginController extends Controller
{
    public function exitLogin(){
        session(null);
        $this->display('index');
    }
    /**
     *加载登录模块
     */
    public function index()
    {
//        echo getRandStr(10);exit();
//        echo makeEveryNumber('UI',1);
//        echo md5(md5(123456));
//        exit();
        $this->display();
    }


    /**
     *登录成功
     */
    public function login()
    {
        $phone = I('post.phone');
        $username = I('post.username');
        $password = I('post.password');
        if (!empty($phone)) {
            $where['phone'] = $phone;
        }
        if (!empty($username)) {
            $where['uid'] = $username;
        }

        $subUserModel = D('User/SubUser');
        $info = $subUserModel->login($where);
        if (empty($info)) {
            $this->error('员工不存在');
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
//            echo session('uid');exit();
            session('password', null);
            $this->success('登录成功');
            exit;
        }
    }
}