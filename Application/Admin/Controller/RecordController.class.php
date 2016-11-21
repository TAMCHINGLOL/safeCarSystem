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

    public function __construct()
    {
        $this->recordModel = D('Settle/Record');
        $this->payModel = D('Pay/Pay');
    }

    /**
     *同意理赔通过
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
                $payCode = empty(I('post.payCode')) ? '银联支付' : I('post.payCode');
                $price = I('post.price');
                $createTime = date('Y-m-d H:i:s');
                $remark = I('post.remark');
                $id = $this->payModel->addNewRow($carUid,$dealUid,$financeUid,$recordSn,$payCode,$price,$createTime,$status,$remark);
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
     *拒绝理赔通过
     */
    public function cancelPass(){
        $status = I('post.status');
        $remark = I('posy.remark');
        $recordSn = I('post.recordSn');
        if($status == 2){
            $rs = $this->recordModel->refusePassByRecordSn($recordSn,$status,$remark);
            if($rs){
                $this->success('成功拒绝,正在向系统发聩');
                exit;
            }else{
                $this->error('拒绝失败');
                exit;
            }
        }
    }
}