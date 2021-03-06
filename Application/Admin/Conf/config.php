<?php
return array(
    'DEFAULT_THEME'     =>    'Default', //后台模板主题
    //'TMPL_ENGINE_TYPE'  =>    'Smarty',
    'TMPL_ACTION_ERROR' => 'Public:error',    //错误页面
    'TMPL_ACTION_SUCCESS' => 'Public:success',      //成功页面

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
        'DB_NAME' => 'bfm_dev', // 数据库名
        'DB_USER' => 'root', // 用户名
        'DB_PWD' => '123456', // 密码
        'DB_PORT' => '3306', // 端口
    ),

    //日志设置
    'LOG_RECORD'            =>  false,   // 默认不记录日志
    'LOG_TYPE'              =>  'File', // 日志记录类型 默认为文件方式
    'LOG_LEVEL'             =>  'EMERG,ALERT,CRIT,ERR',// 允许记录的日志级别
    'LOG_EXCEPTION_RECORD'  =>  false,    // 是否记录异常信息日志
);