<?php
/**
 * @Tool: PhpStorm.
 * @Company:
 * @Author: zml
 * @Since: 2016/11/22 22:42
 * @Description: 描述
 */

namespace Staff\Controller;


use Common\Controller\CommonController;

class PayController extends CommonController
{
    protected $userModel;
    protected $recordModel;
    protected $payModel;
    protected $bankPayModel;

    public function __construct()
    {
        $this->userModel = D('User/User');
        $this->recordModel = D('Settle/Record');
        $this->payModel = D('Pay/Pay');
        $this->bankPayModel = D('Pay/BankPay');
    }

    /**
     *完成最终理赔
     */
    public function finallyPaySuccess(){
        $recordSn = I('post.recordSn');
        $paySn = I('post.paySn');
        $carUid = I('post.uid');        //车主uid
        $uid = session('uid');
        $payPwd = I('post.Pwd');
        $password = md5(md5($payPwd));  //共三次加密,前端加密一次
        $surePwd = $this->bankPayModel->findPassword($uid);
        if ($surePwd == $password) {
            $userInfo = $this->userModel->getRowByUid($carUid);
            $content = '尊敬的' . $userInfo['username'] . '车主,你好!理赔金额已经成功到账,如有疑问,请拨打客服电话：123123';
            $data = array($content, 60);
            $tempId = '1';
            sendTemplateSMS($userInfo['phone'], $data, $tempId);
            $this->recordModel->changeStatusByRecordSn($recordSn, 3);    //改变理赔登记表状态
            $this->payModel->changeStatusByPaySn($paySn, 3);             //改变支付表状态
            $this->success('已通知车主理赔成功');
            exit;
        } else {
            $this->error('支付密码错误');
            exit;
        }
    }

    /**
     *完成支付密码
     */
    public function surePay()
    {
        $recordSn = I('post.recordSn');
        $paySn = I('post.paySn');
        $carUid = I('post.uid');        //车主uid
        $uid = session('uid');
        $payType = empty(I('post.payCode')) ? '银联支付' : I('post.payCode');
        $payPwd = I('post.Pwd');
        $password = md5(md5($payPwd));  //共三次加密,前端加密一次
        $surePwd = $this->bankPayModel->findPassword($uid);
        if ($surePwd == $password) {
            $userInfo = $this->userModel->getRowByUid($carUid);
            $content = '尊敬的' . $userInfo['username'] . '车主,你好!理赔金额预计1-3个工作日到账,如有疑问,请拨打客服电话：123123';
            $data = array($content, 60);
            $tempId = '1';
            sendTemplateSMS($userInfo['phone'], $data, $tempId);
            $this->recordModel->changePassByRecordSn($recordSn, 2);    //改变理赔登记表状态
            $this->payModel->changeStatusByPaySn($paySn, 2, $payType); //改变支付表状态和支付方式
            $this->success('支付成功,预计1-3个工作日完成转账');
            exit;
        } else {
            $this->error('支付密码错误');
            exit;
        }
    }

    /**
     *财务人员根据状态回去对应列表(状态)
     */
    public function payList(){
        $status = I('post.status');
        $financeUid = session('uid');
        $payList = $this->payModel->getListByFinanceUid($financeUid,$status);
        $this->saaign('payList',$payList);
        $this->display();
    }
}