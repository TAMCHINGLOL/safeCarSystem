<?php
/**
 * @Tool: PhpStorm.
 * @Company:
 * @Author: zml
 * @Since: 2016/11/23 18:24
 * @Description: 描述
 */

namespace Admin\Controller;


use Common\Controller\BaseController;
use Common\Controller\CommonController;

class PayController extends BaseController
{
    protected $payModel;
    protected $subUserModel;
    protected $adminModel;

    public function __construct()
    {
        $this->payModel = D('Pay/Pay');
        $this->subUserModel = D('User/SubUser');
        $this->adminModel = D('User/Admin');
    }

    /**
     *通知财务人员进行支付(用于未处理的支付单)
     */
    public function noticeStaffDeal(){
        $financeUid = I('post.financeUid');
        $paySn = I('post.paySn');
        $uid = session('uid');
        $subUserInfo = $this->subUserModel->getRowByUid($financeUid);   //获取财务人员个人信息
        $userInfo = $this->adminModel->getNameByUid($uid);
        $content = '敬爱的'.$financeUid.'员工!,系统通知你有一份理赔支付单：'.$paySn.'需处理,请插眼传送登录系统,完成操作,报告人：'.$userInfo.'经理';
        $data = array($content,10);
        $tempId = '1';
        $rs = sendTemplateSMS($subUserInfo['phone'],$data,$tempId);
        if($rs){
            $this->success('系统正在火速通知中...');
            exit;
        }else{
            $this->error('通知跑偏了,建议电话联系工作人员');
            exit;
        }
    }

    /**
     *根据状态获取对应的负责人的支付列表(待支付/正在支付/已支付)
     */
    public function getPayList(){
        $uid = session('uid');
        $status = I('post.status');
        $payList = $this->payModel->getListByDealerUid($uid,$status);
        $this->assgin('payList',$payList);
        $this->display();
    }
}