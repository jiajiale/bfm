<?php

namespace Admin\Rules;

class MenuRule{
    public static $_validate = array(
        'name'  => array(
            'required'  =>  '菜单名称必须填写',
//            'regexp(^[a-z]$)'  =>  '菜单名称必须填写',
            'alpha'     =>  '菜单名称必须为字母'
         ),
        'url'   => array(
            'url'       =>  '必须为url格式'
        ),
        'sort'  => array(
            'required'  =>  '排序必须填写',
            'between(1,20)' =>  '排序在1-20之间'
        )
    );
}
