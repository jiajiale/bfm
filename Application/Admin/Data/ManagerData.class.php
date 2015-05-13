<?php
/**
 * Created by PhpStorm.
 * User: KU04PC
 * Date: 2015/5/11
 * Time: 21:07
 */

namespace Admin\Data;

class ManagerData extends BaseData{

    /**
     * 管理员登陆
     * @param $username
     * @param $password
     * @return int
     */
    public function login($username, $password){
        $map = array();
        $map['username'] = $username;

        $manager = $this->where($map)->find();
        if(is_array($manager) && $manager['status']){
            if(hash_password($password, C('PASSWORD_SALT_KEY')) === $manager['password']){
                $this->updateManagerLogin($manager['id']); //更新用户登录信息
                return $manager['id']; //登录成功，返回用户ID
            } else {
                return -2; //密码错误
            }
        } else {
            return -1; //用户不存在或被禁用
        }
    }


    /**
     * 更新管理员登陆信息
     * @param $muid
     */
    protected function updateManagerLogin($muid){
        $data = array(
            'id'              => $muid,
            'last_login_time' => NOW_TIME,
            'last_login_ip'   => get_client_ip(1),
        );
        $this->save($data);
    }
}