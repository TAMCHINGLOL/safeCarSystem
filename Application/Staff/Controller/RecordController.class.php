<?php
/**
 * @Tool: PhpStorm.
 * @Company:
 * @Author: zml
 * @Since: 2016/11/21 11:09
 * @Description: 描述
 */

namespace Staff\Controller;


use Common\Controller\CommonController;

class RecordController extends CommonController
{
    protected $inspectModel;
    protected $userModel;
    protected $subUserModel;
    protected $recordModel;
    protected $carMessageModel;
    protected $policyTypeModel;
    protected $payModel;
    protected $bankPayModel;

    public function __construct()
    {
        $this->userModel = D('User/User');
        $this->subUserModel = D('User/SubUser');
        $this->carMessageModel = D('Car/Message');
        $this->recordModel = D('Settle/Record');
        $this->inspectModel = D('Settle/Inspect');
        $this->policyTypeModel = D('Settle/PolicyType');
        $this->payModel = D('Pay/Pay');
        $this->bankPayModel = D('Pay/BankPay');
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
        $payPwd = I('post.Pwd');
        $password = md5(md5($payPwd));  //共三次加密,前端加密一次
        $surePwd = $this->bankPayModel->findPassword($uid);
        if ($surePwd == $password) {
            $userInfo = $this->userModel->getRowByUid($carUid);
            $content = '尊敬的' . $userInfo['username'] . '车主,你好!理赔金额预计1-3个工作日到账,如有疑问,请拨打客服电话：123123';
            $data = array($content, 60);
            $tempId = '1';
            sendTemplateSMS($userInfo['phone'], $data, $tempId);
            $this->recordModel->changeStatusByRecordSn($recordSn, 2);    //改变理赔登记表状态
            $this->payModel->changeStatusByPaySn($paySn, 2);             //改变支付表状态
            $this->success('支付成功,预计1-3个工作日完成转账');
            exit;
        } else {
            $this->error('支付密码错误');
            exit;
        }
    }

    /**
     * 获取对应理赔的在线帮助文档
     * @param $typeSn
     * @return string
     */
    protected function getSettleHelp($typeSn)
    {
        if (empty($typeSn)) {
            return '';
        }
        return $this->policyTypeModel->getRowByTypeSn($typeSn);
    }

    /**
     *完成初级审核,新增理赔记录信息
     */
    public function surePass()
    {
        $financeUid = session('uid');
        $carUid = I('post.uid');                   //车主Uid
        $car_sn = I('post.car_sn');             //车辆编号
        $policy_sn = I('post.policy_sn');       //基本保单编号
        $type_sn = I('post.type_sn');           //保险种类编号
        $inspect_sn = I('post.inspect_sn');     //理赔登记编号
        $add_time = I('post.add_time');         //事故地址
        $address = I('post.address');           //事故地址
        $amount = I('post.amount');             //理赔总金额
        $remark = I('post.remark');             //财务备注
        $create_time = date('Y-m-d H:i:s');     //理赔记录创建时间
        $id = $this->recordModel->addNewRow($carUid, $financeUid, $inspect_sn, $car_sn, $policy_sn, $type_sn, $add_time, $address, $create_time, $amount, $remark);

        $record_sn = makeEveryNumber('RS', $id);
        $rs = $this->recordModel->addRecordSnById($id, $record_sn);
        if ($rs) {
            $this->success('成功录入系统,等待审核');
            exit;
        } else {
            $this->error('录入系统失败,稍后重试...');
            exit;
        }
    }

    /**
     *获取某一理赔登记详情
     */
    public function getOneInspect()
    {
        $inspectSn = I('post.inspectSn');
        $inspectInfo = $this->inspectModel->getRowByInspectSn($inspectSn);
        $inspectArray = array();
        $userInfo = array();
        $headerList = array();
        $bodyList = array();
        $footerList = array();
        $otherList = array();
        foreach ($inspectInfo as $k => $v) {
            $userInfo = $this->userModel->getRowByUid($v['uid']);
            $carInfo = $this->carMessageModel->getRowByCarSn($v['car_sn']);
            $inspectUser = $this->subUserModel->getRowByUid($v['inspect_uid']);
            $inspectArray['inspect_sn'] = $v['inspect_sn'];
            $inspectArray['happen_time'] = $v['happen_time'];
            $inspectArray['address'] = $v['address'];
            $headerList = explode(',', $v['header_img_list']);
            $bodyList = explode(',', $v['body_img_list']);
            $footerList = explode(',', $v['footer_img_list']);
            $otherList = explode(',', $v['other_img_list']);
            $inspectArray['base_img'] = $v['base_img'];
            $inspectArray['start_time'] = $v['start_time'];
            $inspectArray['end_time'] = $v['end_time'];
        }
        $this->assign('headerList', $headerList);
        $this->assign('bodyList', $bodyList);
        $this->assign('footerList', $footerList);
        $this->assign('otherList', $otherList);
        $this->assign('userInfo', $userInfo);
        $this->assign('subUserInfo', $inspectUser);
        $this->assign('carInfo', $carInfo);
        $this->assign('inspectInfo', $inspectArray);
        $this->display();
    }

    /**
     *获取待审核理赔登记列表分页
     */
    public function getInspectList()
    {
        $status = 3;
        $inspectList = $this->inspectModel->findInspectList($status);
        $inspectInfo = array();
        foreach ($inspectList as $k => $v) {
            $inspectInfo[$k]['uid'] = $v['uid'];
            $inspectInfo[$k]['inspect_uid'] = $v['inspect_uid'];
            $inspectInfo[$k]['happen_time'] = $v['happen_time'];
            $inspectInfo[$k]['inspect_sn'] = $v['inspect_sn'];
//            $inspectInfo[$k]['car_sn'] = $v['car_sn'];
//            $inspectInfo[$k]['policy_sn'] = $v['policy_sn'];
//            $inspectInfo[$k]['type_sn'] = $v['type_sn'];
        }
        $this->assign('inspectList', $inspectInfo);
        $this->display();
    }
}