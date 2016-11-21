<?php

/**
 * @Tool: PhpStorm.
 * @Company:
 * @Author: zml
 * @Since: 2016/11/21 16:35
 * @Description: 描述
 */
namespace Pay\Model;

use Think\Model;

class BankPayModel extends Model
{
    protected $trueTableName = 'bank_pay_message';

    public function findPassword($uid){
        $where['uid'] = $uid;
        return $this->where()->getField('password');
    }
}