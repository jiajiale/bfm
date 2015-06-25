<?php
/**
 * Created by PhpStorm.
 * User: KU04PC
 * Date: 2015/5/11
 * Time: 21:45
 */

namespace Admin\Model;


class ManagerAccountModel extends BaseModel{
    // 自动完成
    protected $_auto = array(
        array('status', 1, self::MODEL_INSERT, 'string'),
        array('gmt_create', 'time', self::MODEL_INSERT, 'function'),
        array('gmt_last_login', 'time', self::MODEL_INSERT, 'function'),
        array('last_ip', 'get_client_ip', self::MODEL_INSERT, 'function'),
        array('password', 'hash_password', self::MODEL_BOTH, 'function'),
    );
}