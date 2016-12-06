<?php
/**
 * @Tool: PhpStorm.
 * @Company:
 * @Author: zml
 * @Since: 2016/11/20 15:07
 * @Description: 描述辅助客服人员/财务人员对象
 */

namespace Staff\Controller;


use Common\Controller\CommonController;

class PersonController extends CommonController
{
    public function inspectList(){
        $address = I('get.address');
        $flag = I('get.flag');
        $inspectSn = I('get.inspectSn');
        if(!empty($flag)){
            $this->assign('flag',$flag);
        }
        if(!empty($inspectSn)){
            $this->assign('inspectSn',$inspectSn);
        }
//        echo $inspectSn;exit();
        $sAddress = session('happenAddress');
        if(empty($sAddress)){
            $happenAddress = $address;
        }else{
            $happenAddress = $sAddress;
        }
        $subUserModel = D('User/SubUser');
        $inspectList = $subUserModel->getUserListBy(2,2,1,$happenAddress);
        $this->assign('carUid',session('carUid'));
        $this->assign('inspectList',$inspectList);
        session('happenAddress',null);
        session('carUid',null);
        $this->display();
    }
}