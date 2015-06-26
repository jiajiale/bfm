<?php
namespace Admin\Controller;
use Think\Controller;

class BaseController extends Controller {

    /**
     * @var \Admin\Logic\MenuLogic
     */
    protected $menuLogic;
    /**
     * @var \Admin\Logic\ManagerAccountLogic
     */
    protected $managerAccountLogic;

    public function __construct(){
        parent::__construct();

        $this->menuLogic = D('Menu','Logic');
        $this->managerAccountLogic = D('ManagerAccount','Logic');
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
     * @param string $referer
     * @param int $code
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
     * @param string $referer
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
     * @param string $msg
     * @param string $referer
     */
    public function ajaxAuto($flag,$msg = '操作',$referer = ''){
        if($flag !== false){
            $this->ajaxSuccess(null,$msg.'成功',$referer);
        }else{
            $this->ajaxError($msg.'失败',$referer);
        }
    }

    /**
     * 检查管理员是否登录
     */
    protected function check_login(){
        if($mid = is_login()){
            $managerData = $this->managerAccountLogic->getById($mid);
            $menuTree = $this->menuLogic->getMenuTreeByRoleId($managerData['role_id']);
            $this->assign('menuTree',$menuTree);
            $this->assign('managerData',$managerData);
        }else {
            $error = '请先登录！';
            $this->error($error,'Public/index');
        }
    }

}