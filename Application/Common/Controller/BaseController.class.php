<?php
/**
 * @Tool: PhpStorm.
 * @Company:
 * @Author: ldz
 * @Since: 2016/12/7 1:28
 * @Description: 描述
 */

namespace Common\Controller;


use Think\Controller;

class BaseController extends Controller
{
    public function _initialize(){
//        if($_SESSION['sadminuid'] == null){
//            $_SESSION['sadminuid'] = 'UC0000000001';
//        }
        header("Content-type: text/html; charset=utf-8");  //把所有的头文件都设置字符编码为utf-8;
        if($_SESSION['adminUid'] == null || !isset($_SESSION['adminUid'])){
            session(null);
//             $this->error('登录已过期,正在跳转...','index.php/Home/Login/index.html',2);
            $this->redirect('admin/Login/index');
            exit();
        }
        $user = M('admin') -> where("uid='".$_SESSION['adminUid']."'") -> find();
        $this -> assign('user', $user);
    }

    public function __construct()
    {
        parent::__construct();
    }
}