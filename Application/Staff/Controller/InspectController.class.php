<?php
/**
 * @Tool: PhpStorm.
 * @Company:
 * @Author: zml
 * @Since: 2016/11/20 13:46
 * @Description: 描述用于理赔登记表的操作(同一对象面向客服系统/勘察系统)
 */

namespace Staff\Controller;


use Common\Controller\CommonController;

class InspectController extends CommonController
{
    protected $inspectModel;
    protected $subUserModel;
    protected $userModel;
    protected $carMessage;

    public function __construct()
    {
        parent::__construct();
        $this->inspectModel = D('Settle/Inspect');
        $this->subUserModel = D('User/SubUser');
        $this->userModel = D('User/User');
        $this->carMessage = D('Car/Message');
    }

    /**
     * 添加/修改勘察记录
     * @Author: ludezh
     */
    public function doInspectRow(){
        $carSn = I('post.carSn');
        $inspectSn = I('post.inspectSn');
        $flag = I('post.flag');
        $remark1 = I('post.remark1');
        $remark2 = I('post.remark2');
        $remark3 = I('post.remark3');
        $remark4 = I('post.remark4');
        $endTime = date('Y-m-d H:i:s');
        $headList = session('picStr');
        $inspectModel = D('Settle/Inspect');
        if($flag == 1 || $flag == 2){ //修改
            $rs = $inspectModel->completeUpdate($inspectSn, 3, $headList, $remark1, $remark2, $remark4, '', $remark3, $endTime);
            if($rs){
                $this->success('操作成功');
                exit();
            }else{
                $this->error('操作失败');
                exit();
            }
        }else{
            $this->error('非法操作');exit();
        }
    }
    /**
     * 图片上传
     * @Author: ludezh
     */
    public function picUpload(){
        $picStr = session('picStr');
        $data = picUpload();
        if(empty($picStr)){
            $picUrlStr = $data['info'];
        }else{
            $picUrlStr = $picStr.','.$data['info'];
        }
        session('picStr',$picUrlStr);
    }

    /**
     * @Author: ludezh
     */
    public function surveyReporter(){
        $carSn = I('get.carSn');
        $inspectUid = I('get.inspectUid');
        $inspectSn = I('get.inspectSn');
        $flag = I('get.flag');
        $inspectModel = D('Settle/Inspect');
        $inspectInfo = $inspectModel->getInspectInfoByInspectSn($inspectSn,$inspectUid);
        $picArr = explode(',',$inspectInfo['header_img_list']);
        $picUrlArr = array();
        foreach($picArr as $k => $v){
            $picUrlArr[$k]['pic'] = substr($v, strrpos($v, '../')+2);
        }
//        print_r($picUrlArr);exit();
        $carModel = D('Car/Message');
        $carInfo = $carModel->getRowByCarSn($inspectInfo['car_sn']);
        $this->assign('flag',$flag);
        $this->assign('picArr',$picUrlArr);
        $this->assign('inspectInfo',$inspectInfo);
        $this->assign('carInfo',$carInfo);
        $this->display();
    }

    /**
     * 加载待处理记录
     * @Author: ludezh
     */
    public function surveyList(){
        $inspectModel = D('Settle/Inspect');
        $carModel = D('Car/Message');
        $uid = session('uid');
        $status = array('neq',1);
        $inspectList = $inspectModel->getListByInspectUid($uid,$status);
        foreach($inspectList as $k => $v){
            $carSn = $carModel->getRowByCarSn($v['car_sn']);
            $inspectList[$k]['plate_num'] = $carSn['plate_num'];
        }
        $this->assign('inspectList',$inspectList);
        $this->display();
    }

    /**
     * 加载已结案记录
     * @Author: ludezh
     */
    public function endSurvey(){
        $status = 6;
        $uid = session('uid');
        $inspectList = $this->inspectModel->getInspectListByInspect($status,$uid);
        $this->assign('inspectList',$inspectList);
        $this->display();
    }

    /**
     * 根据勘察id查找信息
     * @Author: ludezh
     */
    public function getInspectInfo(){
        $inspectSn = I('post.inspectSn');
        if($inspectSn){
            $inspectModel = D('Settle/Inspect');
            $carModel = D('Car/Message');
            $userModel = D('User/User');
            $inspectInfo = $inspectModel->getRowByInspectSn($inspectSn);
            $inspectInfo['carInfo'] = $carModel->getRowByUid($inspectInfo['uid']);
            $inspectInfo['userInfo'] = $userModel->getRowByUid($inspectInfo['uid']);
            $this->success($inspectInfo);
            exit();
        }else{
            $this->error('非法操作');
            exit();
        }
    }

    /**
     *入勤填写勘察信息[完善理赔登记信息]
     */
    public function updateInspect(){
        $carUid = I('post.carUid');        //车主Uid
        $plateNum = I('post.plateNum');    //车牌号
        $inspectSn = I('post.inspectSn');
        $status = 3;
        $headList = session('headList');
        $bodyList = session('bodyList');
        $footerList = session('footerList');
        $otherList = session('otherList');
        $baseImg = session('baseImg');      //登记表基本信息(含车主确认签名)
        $remark = I('post.remark');
        $endTime = date('Y-m-d H:i:s');
        $rs = $this->inspectModel->completeUpdate($inspectSn,$status,$headList,$bodyList,$footerList,$otherList,$baseImg,$remark,$endTime);
        if($rs){
            $userInfo = $this->userModel->getRowByUid($carUid);
            $content = '尊敬的'.$userInfo['username'].'车主,你好!'.$plateNum.'理赔信息已经登记入系统,正在拼命审核中,预计1-3个工作日';
            $data = array($content,60);
            $tempId = '1';
            sendTemplateSMS($userInfo['phone'],$data,$tempId);
            $this->success('提 交 成 功');
            exit;
        }else{
            $this->error('提交失败');
            exit;
        }
    }

    /**
     *勘察人员接单出勤
     */
    public function changeStatus(){
        $uid = session('uid');
        $inspectSn = I('post.inspectSn');
        $status = 2;
        $date = date('Y-m-d H:i:s');
        $rs = $this->inspectModel->changeStatus($uid,$inspectSn,$status,$date);
        if($rs){
            $carUid = I('post.carUid');
            $carUserInfo = $this->userModel->getRowByUid($carUid);
            $content = '尊敬的'.$carUserInfo['real_name'].'客户,员工编号:'.$uid.'正在插眼传送中,预计15分钟内到达地点';
            $data = array($content,15);
            $tempId = '1';
            sendTemplateSMS($carUserInfo['phone'],$data,$tempId);
            $this->success('接单成功,正在短信通知车主');
            exit;
        }else{
            $this->error('接单失败');
            exit;
        }
    }

    /**
     *获取获取某一个理赔登记详情(区别客服/勘察获取对应的信息)
     */
    public function oneInspect()
    {
        $inspectSn = I('get.inspectSn');
        $inspectInfo = $this->inspectModel->getRowByInspectSn($inspectSn);
        $inspectArray = array();
        $userInfo = array();
        $headerList = array();
        $bodyList = array();
        $footerList = array();
        $otherList = array();
        $subUserInfo = array();
//        print_r($inspectInfo['uid']);exit();
//        foreach($inspectInfo as $k => $v){
            $userInfo = $this->userModel->getRowByUid($inspectInfo['uid']);
            $carInfo = $this->carMessage->getRowByCarSn($inspectInfo['car_sn']);
            $subUserInfo = $this->subUserModel->findRowByUid($inspectInfo['inspect_uid']);
//            foreach($subUserInfo as $k1 => $v1){
                switch($subUserInfo['is_online']){
                    case 1:
                        $str = '下班';
                        break;
                    case 2:
                        $str = '闲置';
                        break;
                    case 3:
                        $str = '出勤';
                        break;
                    case 4:
                        $str = '请假';
                        break;
                    default:
                        $str = '';
                        break;
//                }
        }
        $subUserInfo['status'] = $str;
        $inspectArray['inspect_sn'] = $inspectInfo['inspect_sn'];
        $inspectArray['happen_time'] = $inspectInfo['happen_time'];
        $inspectArray['address'] = $inspectInfo['address'];
        $inspectArray['cremark'] = $inspectInfo['custom_remark'];
        $inspectArray['iremark'] = $inspectInfo['inspect_remark'];
        $headerList = explode(',',$inspectInfo['header_img_list']);
        $bodyList = explode(',',$inspectInfo['body_img_list']);
        $footerList = explode(',',$inspectInfo['footer_img_list']);
        $otherList = explode(',',$inspectInfo['other_img_list']);
        $inspectArray['base_img'] = $inspectInfo['base_img'];
        $inspectArray['start_time'] = $inspectInfo['start_time'];
        $inspectArray['end_time'] = $inspectInfo['end_time'];
//        }

        session('carUid',$inspectInfo['uid']);
        $this->assign('headerList',$headerList);
        $this->assign('bodyList',$bodyList);
        $this->assign('footerList',$footerList);
        $this->assign('otherList',$otherList);
        $this->assign('userInfo',$userInfo);
        $this->assign('carInfo',$carInfo);
        $this->assign('inspectInfo',$inspectArray);
        $this->assign('subUserInfo',$subUserInfo);
        $this->display();
    }

    /**
     *根据不同状态和工作人员的uid获取勘察登记列表分页
     * 客服待确定/客服待通知/勘察待处理/勘察处理中/财务待审核(可不传uid方法在Record控制器中)/勘察待确定/已处理
     */
    public function inspectList()
    {
        $status = I('get.status');
        $uid = session('uid');
        if(empty($status)){
            $status = 1;
        }
        $inspectList = $this->inspectModel->getInspectListByCustom($status,$uid);
        $data = array();
        foreach($inspectList as $k => $v){
            if($v['status'] != 5 || $v['status'] != 6){
                switch($v['status']) {
                    case 1:
                        $str = '等待调度确认';
                        break;
                    case 2:
                        $str = '调度勘察中';
                        break;
                    case 3:
                        $str = '待审核';
                        break;
                    case 4:
                        $str = '待确认';
                        break;
                    case 7:
                        $str = '待处理';
                        break;
                    case 8:
                        $str = '未调度勘察';
                        break;
                    default:
                        $str = '未知状态';
                        break;
                }
                $data[$k]['inspect_sn'] = $v['inspect_sn'];
                $data[$k]['happen_time'] = $v['happen_time'];
                $data[$k]['address'] = $v['address'];
                $data[$k]['inspect_uid'] = $v['inspect_uid'];
                $data[$k]['custom_remark'] = $v['custom_remark'];
                $data[$k]['status'] = $str;
            }
        }
        $this->assign('inspectList',$data);
        $this->display();
    }


    /**
     *客服点击立即调度(短信通知调度人员/报案车主)
     */
    public function sendInspect(){
        $phone = I('post.phone');       //勘察人员手机号
//        echo $phone;exit();
        $uid = I('post.uid');           //勘察人员的uid
        $flag = I('post.flag');
        $inspectSn = I('post.inspectSn');
        $userInfo = $this->subUserModel->getRowByUidPhone($uid,$phone);
        if($userInfo['phone']){
            if(!empty($flag) && !empty($inspectSn)){
                $res = $this->inspectModel->updateInspectInfo($inspectSn, $uid,1);
            }else{
                $inspectSn = session('newInspectSn');
                $res = $this->inspectModel->bindInspectUid($uid,$inspectSn,1);
            }
            if(!$res){
                $this->error('绑定勘察人员成功,建议使用电话联系');
                exit;
            }
            $str = '员工编号:'.$userInfo['uid'].',你好!系统通知:你有新的出勤订单,订单编号：'.$inspectSn.',请立即登录系统进行核对出勤';
            $data = array($str,10);
            $tempId = "1";

            $rs = sendTemplateSMS($phone,$data,$tempId);
            if ($rs) {
                $carUid = session('carUid');
                $carUserInfo = $this->userModel->getRowByUid($carUid);
                $str1 = '尊敬的'.$carUserInfo['real_name'].'客户,系统正在拼命通知员工编号:'.$userInfo['uid'].'为您处理，请耐心等待';
                $data1 = array($str1,10);
                $tempId1 = "1";
                sendTemplateSMS($carUserInfo['phone'],$data1,$tempId1);
                $this->success('短 信 正 在 通 知...');
                exit();
            } else {
                $this->error('短信服务跑偏了,建议电话联系车主');
                exit();
            }
        }else{
            $this->error('该勘察人员已经不存在');
            exit;
        }

    }

    /**
     *生成基本理赔登记信息
     */
    public function addInspect(){
        $carUid = I('post.uid');
        $carSn = I('post.carSn');
        $policySn = I('post.policySn');
        $typeSn = I('post.typeSn');
        $address = I('post.address');
        $remark = I('post.remark');
        $customUid = session('uid');
        $happenTime = date('Y-m-d H:i:s');
        $rs = $this->inspectModel->addRow($carUid,$carSn,$policySn,$typeSn,$address,$remark,$customUid,$happenTime);
        if($rs){
            $inspectSn = makeEveryNumber('IS',$rs);
            session('newInspectSn',$inspectSn);
            session('carUid',$carUid);
            session('happenAddress',$address);
            $this->inspectModel->addInspectSnById($rs,$inspectSn);
            $this->success('新增调度信息成功');
            exit;
        }else{
            $this->error('新增调度信息失败');
            exit;
        }
    }

    /**
     *获取在线可调度人员列表
     */
    public function getYardList(){
        $address =  I('post.address');
        $userList = $this->subUserModel->getUserListBy(1,2,1,$address);
        $this->assign('userList',$userList);
        $this->display();
    }

}