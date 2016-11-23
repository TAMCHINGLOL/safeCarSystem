<?php
/**
 * @Tool: PhpStorm.
 * @Company:
 * @Author: zml
 * @Since: 2016/11/20 11:36
 * @Description: 描述
 */

namespace Staff\Controller;


use Common\Controller\CommonController;

class CarController extends CommonController
{
    protected  $carMessageModel;
    protected $policyBaseModel;

    public function __construct()
    {
        $this->carMessageModel = D('Car/Message');
        $this->policyBaseModel = D('Settle/PolicyBase');
    }

    /**
     *短信通知未参保/参保过期的车主(客服挖掘潜在客户/服务已存在客户)
     */
    public function sendNotice(){
        $carSn = I('post.carSn');
        $carInfo = $this->carMessageModel->getRowByCarSn($carSn);
        if($carInfo['is_insure'] == 1){
            $content = '尊敬的'.$carInfo['plate_num'].'车主,您好!我司XX车险推出新用户购买大礼包,最高享5.5折,赶紧上车吧';
        }else if($carInfo['is_insure'] == 3){
            $content = '尊敬的'.$carInfo['plate_num'].'车主,您好!我司XX车险推出老用户续保大礼包,最高享4.5折,赶紧上车吧';
        }else{
            $content = '';
        }
        if(empty($content)){
            $this->success('该车辆正在投保在线状态,无需发送续保通知');
            exit;
        }else{
            $data = array($content,60);
            $tempId1 = "1";
            $rs = sendTemplateSMS($carInfo['phone'],$data,$tempId1);
            if($rs){
                $this->success('短 信 正 在 通 知 车 主...');
                exit;
            }else{
                $this->error('短信服务跑偏了,建议电话联系车主');
                exit;
            }

        }
    }

    /**
     *获取某一车辆详情(合法车主的保险信息)
     */
    public function oneCar()
    {
        $carUid = I('post.uid');    //车主Uid
        $carSn = I('post.carSn');   //车辆编号
        $carInfo = $this->carMessageModel->getRowByUidCarSn($carUid,$carSn);
        $policyInfo = $this->policyBaseModel->getRowByUidCarSn($carUid,$carSn);

        //车辆信息
        $this->assign('carInfo',$carInfo);
        //基本保单信息
        $this->assign('policyInfo',$policyInfo);

        $this->display();
    }

    /**
     *获取车辆列表分页显示(查询车主合法性)
     */
    public function carList()
    {
        date_default_timezone_set("Asia/Chongqing");
        $start = I('get.start');                    //页码
        $limit = I('get.length');                   //每页数量
        $filter = I('get.searchValue');             //过滤数组
        $filters = array();
        switch ($filter[0]) {
            case 'status':
                $filters['insure'] = $filter[1];
                break;
            case 'phone':
                $filters['phone'] = $filter[1];
                break;
            case 'keyword':
                $filters['keyword'] = $filter[1];
                break;
            default:
                break;
        }

        $carList = $this->carMessageModel->getCarList($start, $limit, $filters);
        $carTotal = $this->carMessageModel->count();
        if (!empty($carList)) {
            foreach ($carList as $k => $v) {
                //账单状态
                switch ($v['checkStatus']) {
                    case 1:
                        $insure = '暂未投保';
                        break;
                    case 2:
                        $insure = '参保在线';
                        break;
                    case 3:
                        $insure = '投保过期';
                        break;
                    default:
                        $insure = '';
                        break;
                }

                $result['data'][$k] = array(
                    $v['car_sn'],
                    $v['uid'],
                    $v['phone'],
                    $v['plate_num'],
                    $v['brand'],
                    $insure,
                );
            }
        } else {
            $result['data'] = array();
        }
        $result['draw'] = intval($_GET['draw']);
        $result['recordsTotal'] = $carTotal;    //必须
        $result['recordsFiltered'] = $carTotal; //必须
        echo json_encode($result);
        exit;
    }


}