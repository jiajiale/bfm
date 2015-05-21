<?php
namespace Admin\Controller;
use Think\Controller;

class BaseController extends Controller {

    public function __construct(){
        parent::__construct();

        $this->_initialize();
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
    public function ajaxSuccess($data = null, $msg = '',$code = 200)
    {
        $ajaxData = array();
        if (!$msg) $msg = "ok";

        $ajaxData['state'] = 'success';
        $ajaxData['message'] = $msg;
        $ajaxData['data'] = $data;
        $ajaxData['code'] = $code;

        $this->ajaxReturn($ajaxData);
    }

    /**
     * 失败返回
     * @param string $msg
     * @param int $code
     */
    public function ajaxError($msg = '', $code = 300)
    {
        $ajaxData = array();
        if (!$msg) $msg = "fail";

        $ajaxData['state'] = 'success';
        $ajaxData['message'] = $msg;
        $ajaxData['code'] = $code;

        $this->ajaxReturn($ajaxData);
    }

    /**
     * 自动定向成功失败
     * @param $flag
     * @param $msg
     */
    public function ajaxAuto($flag,$msg = '操作'){
        if($flag !== false){
            $this->ajaxSuccess(null,$msg.'成功');
        }else{
            $flag->ajaxError($msg.'失败');
        }
    }
}