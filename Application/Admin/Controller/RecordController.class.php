<?php
/**
 * @Tool: PhpStorm.
 * @Company:
 * @Author: zml
 * @Since: 2016/11/21 18:18
 * @Description: 描述
 */

namespace Admin\Controller;


use Common\Controller\CommonController;

class RecordController extends CommonController
{
    protected $recordModel;
    protected $payModel;
    protected $inspectModel;
    protected $subUserModel;
    protected $adminModel;

    public function __construct()
    {
        parent::__construct();
        $this->recordModel = D('Settle/Record');
        $this->payModel = D('Pay/Pay');
        $this->inspectModel = D('Settle/Inspect');
        $this->subUserModel = D('User/SubUser');
        $this->adminModel = D('User/Admin');
    }

    /**
     *通知尚未确认的理赔报价单的负责人(财务)
     */
    public function noticeStaffDeal(){
        $financeUid = I('post.financeUid');
        $recordSn = I('post.recordSn');
        $uid = session('uid');
        $subUserInfo = $this->subUserModel->getRowByUid($financeUid);   //获取财务人员个人信息
        $userInfo = $this->adminModel->getNameByUid($uid);
        $content = '敬爱的'.$financeUid.'员工!,系统通知你有一份理赔报价单：'.$recordSn.'需确认,请插眼传送登录系统,完成操作,报告人：'.$userInfo.'经理';
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
     *同意理赔通过/主管二级审核[审核通过(生成对应的基本理赔支付单含签名)(用于待审核)
     */
    public function agreePass(){
        $status = I('post.status');
        if($status == 3){
            $remark = I('post.remark');
            $recordSn = I('post.recordSn');
            $rs = $this->recordModel->changePassByRecordSn($recordSn,$status,$remark);
            if($rs){
                $carUid = I('post.Uid');
                $dealUid = session('dealUid');
                $financeUid = I('post.financeUid');
                $payCode = I('post.payCode');
                $payType = empty($payCode) ? '银联支付' : I('post.payCode');
                $price = I('post.price');
                $createTime = date('Y-m-d H:i:s');
                $remark = I('post.remark');
                $id = $this->payModel->addNewRow($carUid,$dealUid,$financeUid,$recordSn,$payType,$price,$createTime,$status,$remark);
                $paySn = makeEveryNumber('PS',$id);
                $result = $this->payModel->addPaySnById($id,$paySn);
                if($result){
                    $this->success('成功处理同意理赔');
                    exit;
                }else{
                    $this->error('同意失效');
                    exit;
                }
            }else{
                $this->error('审核失败');
                exit;
            }
        }else{
            $this->error('非法操作');
            exit;
        }
    }

    /**
     *拒绝理赔通过(用于待审核)
     */
    public function cancelPass(){
        $status = I('post.status');
        $remark = I('posy.remark');
        $recordSn = I('post.recordSn');
        $inspectSn = I('post.inspectSn');
        $dealerUid = session('uid');
        if($status == 2){
            //修改理赔报价单的状态并备注和主管人
            $rs = $this->recordModel->refusePassByRecordSn($recordSn,$dealerUid,$status,$remark);
            if($rs){
                $this->success('成功拒绝,系统正在发聩');
                exit;
            }else{
                $this->error('拒绝失败');
                exit;
            }
        }else{
            //如果状态不是2，先删除生成的理赔报价单,再修改理赔登记表的状态：
            //4审核不通过(客服需确认)，5审核不通过(勘察人员需确认)，7审核不通过，客服联系车主填写完整资料
            $result = $this->recordModel->deleteOldRecordByInspectSnRecordSn($inspectSn,$recordSn);
            if($result){
                $rs = $this->inspectModel->changeStatusByDealer($inspectSn,$dealerUid,$status,$remark);
                if($rs){
                    $this->success('操作成功,系统正在发聩');
                    exit;
                }else{
                    $this->error('操作失败');
                    exit;
                }
            }
        }
    }

    /**
     *根据状态获取理赔报价单列表(审核不通过/审核通过)
     */
    public function getRecordList(){
        $uid = session('uid');
        $status = I('post.status');
        $recordList = $this->recordModel->getRowsByDealerUid($uid,$status);
        if(empty($recordList)){
            $content = '暂无理赔报价记录';
        }
        $this->assign('recordList',$recordList);
        $this->assign('content',$content);
        $this->display();
    }

    /**
     *获取待审核理赔报价单所有记录
     */
    public function getWaitingList(){
        $recordList = $this->recordModel->getRowsWaiting();
        if(empty($recordList)){
            $content = '暂无理赔报价记录';
        }
        $this->assign('recordList',$recordList);
        $this->assign('content',$content);
        $this->display();
    }
}