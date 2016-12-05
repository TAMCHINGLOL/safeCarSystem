<?php
/**
 * @Tool: PhpStorm.
 * @Company:
 * @Author:
 * @Since: 2016/11/16 21:45
 * @Description: 描述
 */

namespace Common\Controller;


use Think\Controller;

class CommonController extends Controller
{
    public function _initialize(){
    	$_SESSION['uid'] = 1;
        header("Content-type: text/html; charset=utf-8");  //把所有的头文件都设置字符编码为utf-8;
        if($_SESSION['uid'] == null || !isset($_SESSION['uid'])){
            session(null);
//             $this->error('登录已过期,正在跳转...','index.php/Home/Login/index.html',2);
            $this->redirect('admin/Login/login');
            exit();
        }
        $user = M('admin') -> where("id='".$_SESSION['uid']."'") -> find();
        $this -> assign('user', $user);
    }
    
    public function __construct()
    {
    	 parent::__construct();
    }
}