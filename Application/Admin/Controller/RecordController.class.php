<?php
/**
 * @Tool: PhpStorm.
 * @Company:
 * @Author: zml
 * @Since: 2016/11/21 18:18
 * @Description: ����
 */

namespace Admin\Controller;


use Common\Controller\BaseController;
use Common\Controller\CommonController;

class RecordController extends BaseController
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
     *֪ͨ��δȷ�ϵ����ⱨ�۵��ĸ�����(����)
     */
    public function noticeStaffDeal(){
        $financeUid = I('post.financeUid');
        $recordSn = I('post.recordSn');
        $uid = session('uid');
        $subUserInfo = $this->subUserModel->getRowByUid($financeUid);   //��ȡ������Ա������Ϣ
        $userInfo = $this->adminModel->getNameByUid($uid);
        $content = '������'.$financeUid.'Ա��!,ϵͳ֪ͨ����һ�����ⱨ�۵���'.$recordSn.'��ȷ��,����۴��͵�¼ϵͳ,��ɲ���,�����ˣ�'.$userInfo.'����';
        $data = array($content,10);
        $tempId = '1';
        $rs = sendTemplateSMS($subUserInfo['phone'],$data,$tempId);
        if($rs){
            $this->success('ϵͳ���ڻ���֪ͨ��...');
            exit;
        }else{
            $this->error('֪ͨ��ƫ��,����绰��ϵ������Ա');
            exit;
        }
    }

    /**
     *ͬ������ͨ��/���ܶ������[���ͨ��(��ɶ�Ӧ�Ļ�����֧������ǩ��)(���ڴ����)
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
                $payType = empty($payCode) ? '����֧��' : I('post.payCode');
                $price = I('post.price');
                $createTime = date('Y-m-d H:i:s');
                $remark = I('post.remark');
                $id = $this->payModel->addNewRow($carUid,$dealUid,$financeUid,$recordSn,$payType,$price,$createTime,$status,$remark);
                $paySn = makeEveryNumber('PS',$id);
                $result = $this->payModel->addPaySnById($id,$paySn);
                if($result){
                    $this->success('�ɹ�����ͬ������');
                    exit;
                }else{
                    $this->error('ͬ��ʧЧ');
                    exit;
                }
            }else{
                $this->error('���ʧ��');
                exit;
            }
        }else{
            $this->error('�Ƿ�����');
            exit;
        }
    }

    /**
     *�ܾ�����ͨ��(���ڴ����)
     */
    public function cancelPass(){
        $status = I('post.status');
        $remark = I('posy.remark');
        $recordSn = I('post.recordSn');
        $inspectSn = I('post.inspectSn');
        $dealerUid = session('uid');
        if($status == 2){
            //�޸����ⱨ�۵���״̬����ע��������
            $rs = $this->recordModel->refusePassByRecordSn($recordSn,$dealerUid,$status,$remark);
            if($rs){
                $this->success('�ɹ��ܾ�,ϵͳ���ڷ���');
                exit;
            }else{
                $this->error('�ܾ�ʧ��');
                exit;
            }
        }else{
            //���״̬����2����ɾ����ɵ����ⱨ�۵�,���޸�����ǼǱ��״̬��
            //4��˲�ͨ��(�ͷ���ȷ��)��5��˲�ͨ��(������Ա��ȷ��)��7��˲�ͨ��ͷ���ϵ������д��������
            $result = $this->recordModel->deleteOldRecordByInspectSnRecordSn($inspectSn,$recordSn);
            if($result){
                $rs = $this->inspectModel->changeStatusByDealer($inspectSn,$dealerUid,$status,$remark);
                if($rs){
                    $this->success('�����ɹ�,ϵͳ���ڷ���');
                    exit;
                }else{
                    $this->error('����ʧ��');
                    exit;
                }
            }
        }
    }

    /**
     *���״̬��ȡ���ⱨ�۵��б�(��˲�ͨ��/���ͨ��)
     */
    public function getRecordList(){
        $uid = session('uid');
        $status = I('post.status');
        $recordList = $this->recordModel->getRowsByDealerUid($uid,$status);
        if(empty($recordList)){
            $content = '�������ⱨ�ۼ�¼';
        }
        $this->assign('recordList',$recordList);
        $this->assign('content',$content);
        $this->display();
    }

    /**
     *��ȡ��������ⱨ�۵����м�¼
     */
    public function getWaitingList(){
        $type = I("get.type");
        if($type==1){
            $where['is_pass'] = 1;
        }
        else{
            $where['is_pass'] = array('in', '2,3');
        }
        $recordList = $this->recordModel->where($where)->select();
        if(empty($recordList)){
            $content = '�������ⱨ�ۼ�¼';
        }
        else{
            foreach($recordList as $k=>$v){
                switch($v['is_pass']){
                    case 1:
                        $recordList[$k]['type'] = "δ���";
                        break;
                    case 2:
                        $recordList[$k]['type'] = "��˲�ͨ��";
                        break;
                    case 3:
                        $recordList[$k]['type'] = "���ͨ��";
                        break;
                }
            }
        }
        $this->assign('recordList',  json_encode($recordList));
        $this->assign('content',$content);
        $this->display("claimingManage");
    }
    /**
     *	�������ⵥ
     */    
    public function lookVerifyClaims()
    {
        //判断是提交还是页面
        if($_POST){
            $result = array('error'=>1,"content"=>"");
            $info['id'] = I('post.id');
            $info['is_pass'] = I("post.value");
            $info['amount'] = I("post.amount");
            $info['remark'] = I("post.remark");
            $res = $this->recordModel->save($info);
            if($res){
                $result['error'] = 0;
                $result['content'] = "修改成功";
            }
            print_r(json_encode($result));exit;
        
        }
        else{
            $id = I("get.id");
            $info = $this->recordModel->find($id);
            $this->assign("info",$info);
            $this->assign("id",$id);
        }
        $this->display();
    }
    /**
     * ���챨��
     */
    public function lookSurveyReporter()
    {
        $id = I("get.id");
        $info = $this->recordModel->table("safe_car_settle_record r")->join(" safe_car_settle_inspect s ON r.record_sn=s.inspect_sn ")
                ->join(" safe_car_user u ON r.uid=u.uid ")
                ->join(" safe_car_message m ON r.car_sn=m.car_sn ")
                ->field("r.*,s.*,u.*,m.*")->where(array("r.id"=>$id))->find();
        $this->assign("info",$info);
        $this->display();
    }
}