<?php
/**
 * @Tool: PhpStorm.
 * @Company:
 * @Author: zml
 * @Since: 2016/11/21 15:50
 * @Description: 描述
 */

namespace Staff\Model;


use Think\Model;

class PolicyTypeModel extends Model
{
    protected $tableName = 'policy_type';

    /**
     * 根据种类编号获取该记录
     * @param $typeSn
     * @return mixed
     */
    public function getRowByTypeSn($typeSn)
    {
        $where['type_sn'] = $typeSn;
        return $this->where($where)->find();
    }
}