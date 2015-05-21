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

/**
 * 获取分页参数
 * @param null $pageIndex
 * @param null $pageSize
 * @return stdClass
 */
function get_page_para($pageIndex = null, $pageSize = null)
{

    if (!$pageIndex) {
        $pageIndex = I('page_index', 1);
    }

    if (!$pageSize) {
        $pageSize = I('page_size', C('PAGE_SIZE', null, 10));
    }

    if ($pageSize < 0 && $pageSize > 50) {
        $pageSize = C('PAGE_SIZE', null, 10);
    }

    $pagePara = new stdClass();
    $pagePara->pageIndex = $pageIndex;
    $pagePara->pageSize = $pageSize;
    return $pagePara;
}