<?php
/**
 * Created by PhpStorm.
 * User: zhuch
 * Date: 2017/4/17
 * Time: 23:56
 */

namespace Admin\Model;
use Think\Model\RelationModel;

class MemberModel extends RelationModel {
    protected $_link = array(
        'Device'=>array(
            'mapping_type'=> self::HAS_MANY,
            'class_name'=>'Device',
            'foreign_key'=>'select_device',
            'mapping_name'=>'allManaged',
            'mapping_order'=>'id'
        ),
    );
}