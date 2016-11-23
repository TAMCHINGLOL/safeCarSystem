<?php
/**
 * @Tool: PhpStorm.
 * @Company:
 * @Author: zml
 * @Since: 2016/11/23 18:38
 * @Description: 描述
 */

namespace Admin\Controller;


use Common\Controller\CommonController;

class InspectController extends CommonController
{
    protected $inspectModel;
    protected $subUserModel;
    protected $adminModel;

    public function __construct()
    {
        $this->inspectModel = D('Settle/Inspect');
        $this->adminModel = D('User/Admin');
        $this->subUserModel = D('User/SubUser');
    }

    /**
     *通知对应员工进行待确认动作
     */
    public function noticeStaffDeal(){
        $subUid = I('post.subUserId');
        $inspectSn = I('post.inspectSn');
        $uid = session('uid');
        $subUserInfo = $this->subUserModel->getRowByUid($subUid);   //获取子帐号个人信息
        $userInfo = $this->adminModel->getNameByUid($uid);
        $content = '敬爱的'.$subUid.'员工!,系统通知你有一份待确认理赔登记单：'.$inspectSn.'需确认,请插眼传送登录系统,完成操作,报告人：'.$userInfo.'经理';
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
     *根据主管uid和状态获取对应的理赔记录列表
     */
    public function getInspectList(){
        $uid = session('uid');
        $status = I('post.status');
        $inspectList = $this->inspectModel->getRowsByDealerUid($uid,$status);
        $this->assign('inspectList',$inspectList);
        $this->display();
    }
}