<?php
/**
 * @Tool: PhpStorm.
 * @Company:
 * @Author: zml
 * @Since: 2016/11/23 20:49
 * @Description: 描述用于保险管理
 */

namespace Admin\Controller;


use Common\Controller\CommonController;

class PolicyController extends CommonController
{
    protected $policyBaseModel;
    protected $policyTypeModel;

    public function __construct()
    {
        $this->policyBaseModel = D('Settle/PolicyBase');
        $this->policyTypeModel = D('Settle/PolicyType');
    }

    /**
     *获取所有基本保单
     */
    public function typeList(){
        $baseList = $this->policyBaseModel->getRows();
        $this->assign('baseList',$baseList);
        $this->display();
    }

    /**
     *添加新的保单类型
     */
    public function addTypePolicy(){

    }

    /**
     *修改保单种类
     */
    public function updateTypePolicy(){

    }

    /**
     *删除保单种类
     */
    public function delTypePolicy(){

    }

    /**
     *批量导出生成excel表
     */
    public function makePolicyList(){

    }

    /**
     *excel批量导入(添加)数据
     */
    public function addAllPolicy(){

    }

    /**
     *获取所有基本保单
     */
    public function baseList(){
        $baseList = $this->policyBaseModel->getRows();
        $this->assign('baseList',$baseList);
        $this->display();
    }

    /**
     *添加新的用户保单
     */
    public function addBasePolicy(){

    }

    /**
     *修改基本保单
     */
    public function updateBasePolicy(){

    }

    /**
     *删除基本保单
     */
    public function delBasePolicy(){

    }
}