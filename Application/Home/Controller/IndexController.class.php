<?php
/**
 * @Tool: PhpStorm.
 * @Company:
 * @Author: zml
 * @Since: 2016/11/19 22:55
 * @Description: 描述
 */

namespace Home\Controller;


use Common\Controller\CommonController;
use Think\Controller;

class IndexController extends CommonController {

    /**
     *加载首页
     */
    public function index(){
        $actionList = session('action_list');
        $actionArray = explode(',',$actionList);
        $this->assign('actionArray',$actionArray);
        $this->display();
    }
    
}