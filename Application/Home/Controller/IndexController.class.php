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
     * 出险登记表页面
     * @Author: ludezh
     */
    public function registerInfo(){
//        echo makeEveryNumber('TS',1);exit();
        $uid = I('get.uid');
        $userModel = D('User/User');
        $userInfo = $userModel->getRowByUid($uid);
        $messageModel = D('Car/Message');
        $carInfo = $messageModel->getRowByUid($uid);
        $policyBaseModel = D('Settle/PolicyBase');
        $policyBaseInfo = $policyBaseModel->getRowByUid($uid);
//        $typeModel = D('Settle/PolicyType');
//        $typeInfo = $typeModel->getRowByUid($uid);
        $this->assign('userInfo',$userInfo);
        $this->assign('carInfo',$carInfo);
        $this->assign('policyInfo',$policyBaseInfo);
//        $this->assign('typeInfo',$typeInfo);
        $this->display();
    }

    /**
     *加载首页
     */
    public function index(){
        $roleId = session('role_id');
        $actionList = session('action_list');
        $actionArray = explode(',',$actionList);
        $this->assign('actionArray',$actionArray);
        $this->assign('roleId',$roleId);
//        echo $roleId;exit();
        $userModel = D('User/User');
        if($roleId == 1){       //客服人员
            $carMessageModel = D('Car/Message');
            $carList = $carMessageModel->getCarList(0, 10000, array());
            foreach($carList as $k => $v){
                $userInfo = $userModel->getRowByUid($v['uid']);
                $carList[$k]['realName'] = $userInfo['real_name'];
                if($v['is_insure'] == 1){
                    $carList[$k]['is_insure'] = '暂未投保';
                }else if($v['is_insure'] == 2){
                    $carList[$k]['is_insure'] = '正在投保';
                }else{
                    $carList[$k]['is_insure'] = '投保过期';
                }
            }
            $this->assign('carList',$carList);
            $this->display('serviceIndex');
        } else if($roleId == 2){    //勘察人员
            $inspectModel = D('Settle/Inspect');
            $uid = session('uid');
            $inspectList = $inspectModel->getListByInspectUid($uid,1);
            $this->assign('inspectList',$inspectList);
            $this->display('inspectIndex');
        } else if($roleId == 3){    //财务
            $this->display();
        }else{
            $this->error('非法操作');
            exit();
        }
    }

    /**
     * 修改密码
     * @Author: ludezh
     */
    public function updatePassword(){
        $oldPwd = I('post.oldPwd');
        $newPwd = I('post.newPwd');
        $subUserModel = D('User/SubUser');
        $uid = session('uid');
        $rs = $subUserModel->findRowByUid($uid);
//        echo json_encode(md5($oldPwd));exit();
        if($rs['password'] == md5($oldPwd)){
            if($oldPwd != md5($newPwd)){
                $rs2 = $subUserModel->update($uid,md5($newPwd));
                if($rs2){
                    $this->success('修改成功');
                    exit();
                }else{
                    $this->error('修改失败');
                    exit();
                }
            }else{
                $this->error('请输入新密码');
                exit();
            }
        }else{
            $this->error('旧密码错误');
            exit();
        }
    }

    /**
     * 忘记密码
     * @Author: ludezh
     */
    public function findPassword()
    {
        $phone = I('post.phone');
        $userModel = D('User/User');
        $phoneRow = $userModel->getRowByPhone($phone);
        if (!$phoneRow) {
            $this->error('手机号不存在');
            exit();
        }

        $uid = session('uid');
        $oldPwd = I('post.oldPwd');
        $newPwd = I('post.newPwd');
        if ($oldPwd != $newPwd) {
            $pwd1 = md5($oldPwd);
            if ($pwd1 != $phoneRow['password']) {
                $pwd2 = md5($newPwd);
                $result = $userModel->updatePassword($uid, $phone, $pwd2);
                if ($result) {
                    $this->success('修改成功');
                    exit();
                } else {
                    $this->error('修改失败');
                    exit();
                }
            } else {
                $this->error('旧密码错误');
                exit();
            }
        } else {
            $this->error('请输入新的密码');
            exit();
        }
    }
}