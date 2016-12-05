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

class IndexController extends CommonController
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

    public function index()
    {
    	$this -> display(':index');
    }
}