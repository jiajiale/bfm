<?php
/**
 * Created by PhpStorm.
 * User: KU04PC
 * Date: 2015/5/6
 * Time: 21:13
 */
namespace Admin\Controller;

class PublicController extends BaseController{

    public function _initialize(){

        $this->manangerData = D('Manager','Data');
    }



    function index(){
        $this->display("login");
    }

    public function login($username = null, $password = null, $verify = null){
        if(IS_POST){
//            //用户登录返回用户登录id或错误号
//            $muid = $this->manangerData->login($username,$password);
//
//            if($muid > 0){
//
//            }else{
//                switch($muid) {
//                    case -1: $error = '用户不存在或被禁用！'; break; //系统级别禁用
//                    case -2: $error = '密码错误！'; break;
//                    default: $error = '未知错误！'; break; // 0-接口参数错误（调试阶段使用）
//                }
//                $this->error($error);
//            }
//        } else {
//            if(is_login()){
//                $this->redirect('Index/index');
//            }else{
//                $this->display();
//            }
            $this->redirect('Index/index');
        }
    }
}