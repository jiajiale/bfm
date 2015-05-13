<?php
/**
 * Created by PhpStorm.
 * User: KU04PC
 * Date: 2015/5/11
 * Time: 21:12
 */

/**
 * 密码二次加密
 * @param $passwordMd5
 * @param $key
 * @return string
 */
function hash_password($passwordMd5, $key = '')
{
    $salt = C('PASSWORD_SALT_KEY');
    return md5(md5(strtolower($passwordMd5) . $salt) . $key);
}