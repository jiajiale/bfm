<?php
return array(
    'DEFAULT_THEME'     =>    'Default', //后台模板主题

    //模板静态文件路径解析
    'TMPL_PARSE_STRING' => array (
        '__IMG__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/images',
        '__CSS__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/css',
        '__JS__'     => __ROOT__ . '/Public/' . MODULE_NAME . '/js',
    ),

    'PASSWORD_SALT_KEY' =>  'BFM!#@$^%',    //密码salt

    'DB_PREFIX' => 'bfm_', // 数据库表前缀
    //数据库配置1
    'DB_MAIN' => array(
        'DB_TYPE' => 'mysqli', // 数据库类型
        'DB_HOST' => '127.0.0.1', // 服务器地址
        'DB_NAME' => 'bmf_dev', // 数据库名
        'DB_USER' => 'root', // 用户名
        'DB_PWD' => '123456', // 密码
        'DB_PORT' => '3306', // 端口
    ),
);