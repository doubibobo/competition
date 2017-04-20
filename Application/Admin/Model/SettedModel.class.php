<?php

/**
 * Created by PhpStorm.
 * User: zhuch
 * Date: 2017/4/17
 * Time: 16:25
 */
namespace Admin\Model;
use Think\Model\RelationModel;
class SettedModel extends RelationModel {
    protected $_link = array(
        'Device'=>array(
            'mapping_type'=> self::HAS_MANY,
            'class_name'=>'Device',
            'foreign_key'=>'sid',
            'mapping_name'=>'allDevice',
            'mapping_order'=>'id'
        ),
    );
}