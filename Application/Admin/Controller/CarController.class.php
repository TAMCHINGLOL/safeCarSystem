<?php
/**
 * @Tool: PhpStorm.
 * @Company:
 * @Author: zml
 * @Since: 2016/11/23 20:58
 * @Description: 描述
 */

namespace Admin\Controller;


use Common\Controller\CommonController;

class CarController extends CommonController
{

    protected $carModel;
    public function __construct()
    {
        $this->carModel = D('Car/Message');
    }

    /**
    *获取所有保险车辆
    */
    public function carList(){
    }

    /**
     *excel导入(添加)保险车辆
     */
    public function addAllCarRow(){

    }

    /**
     *添加新的保险车辆
     */
    public function addCarRow(){

    }

    /**
     *修改保险车辆
     */
    public function updateCarRow(){

    }

    /**
     *删除保险车辆
     */
    public function delCarRow(){

    }

}