<?php
/**
 * @Tool: PhpStorm.
 * @Company:
 * @Author: zml
 * @Since: 2016/11/23 20:49
 * @Description: 描述用于保险管理（暂不考虑新增/修改业务，此属于保险系统非理赔系统业务）
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
     *批量导出保单类型生成excel表
     */
    public function exportTypeList(){

    }

    /**
     *excel批量导入(添加)保单类型
     */
    public function importTypeList(){

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
     *删除保单种类(并不建议删除)
     */
    public function delTypePolicy(){

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
     *批量导出基本保单生成excel表
     */
    public function exportBaseList(){

    }

    /**
     *excel批量导入(添加)基本保单
     */
    public function importBaseList(){

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