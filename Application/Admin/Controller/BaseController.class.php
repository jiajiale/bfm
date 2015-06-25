<?php
namespace Admin\Controller;
use Think\Controller;

class BaseController extends Controller {

    public function __construct(){
        parent::__construct();

        $this->check_login();
    }

    /**
     * 获取有效数据
     */
    public function getAvailableData()
    {
        $data = array();

        $request = I('param.');
        unset($request['page_index']);
        unset($request['page_size']);

        foreach ($request as $key => $value) {
            if ($value != '') {
                $data[$key] = $value;
            }
        }
        return $data;
    }


    /**
     * 成功返回
     * @param null $data
     * @param string $msg
     */
    public function ajaxSuccess($data = null, $msg = '',$referer = '', $code = 200 )
    {
        $ajaxData = array();
        if (!$msg) $msg = "ok";

        $ajaxData['state'] = 'success';
        $ajaxData['message'] = $msg;
        $ajaxData['data'] = $data;
        $ajaxData['code'] = $code;
        $ajaxData['referer'] = $referer;

        $this->ajaxReturn($ajaxData);
    }

    /**
     * 失败返回
     * @param string $msg
     * @param int $code
     */
    public function ajaxError($msg = '', $referer = '', $code = 300)
    {
        $ajaxData = array();
        if (!$msg) $msg = "fail";

        $ajaxData['state'] = 'fail';
        $ajaxData['message'] = $msg;
        $ajaxData['code'] = $code;
        $ajaxData['referer'] = $referer;

        $this->ajaxReturn($ajaxData);
    }

    /**
     * 自动定向成功失败
     * @param $flag
     * @param $msg
     */
    public function ajaxAuto($flag,$msg = '操作',$referer = ''){
        if($flag !== false){
            $this->ajaxSuccess(null,$msg.'成功',$referer);
        }else{
            $this->ajaxError($msg.'失败',$referer);
        }
    }


    final public function check_login(){
        $manager = session('manager_auth');
        if (empty($manager)) {
            //$this->redirect('public/index');
        } else {
           // return session('user_auth_sign') == data_auth_sign($user) ? $user['uid'] : 0;
        }
    }

}