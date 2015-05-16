<?php
/**
 * Created by PhpStorm.
 * User: KU04PC
 * Date: 2015/5/6
 * Time: 21:13
 */
namespace Admin\Controller;


class MenuController extends BaseController{

    public function _initialize(){
        $this->menuLogic = D('Menu', 'Logic');
    }

    /**
     * 数据列表
     */
    public function index(){
        $conditions = $this->getAvailableData();
        $menuList = $this->menuLogic->getList($conditions);

        $this->assign("menuList",$menuList);
        $this->display();
    }


    /**
     * 添加视图
     */
    public function add(){
        $this->display();
    }

    /**
     * 编辑视图
     */
    public function edit(){
        $this->display();
    }

    /**
     * 查看视图
     */
    public function detail(){
        $this->display();
    }

    /**
     * 添加操作
     */
    public function do_add(){
        $data = $this->getAvailableData();
        $result = $this->menuLogic->saveMenu($data);

        $this->ajaxAuto($result,'添加');
    }

    /**
     * 编辑操作
     */
    public function do_edit(){
        $data['state']  = 'success';
        $data['message'] = '提交成功';
        $this->ajaxReturn($data);
    }

    /**
     * 删除操作
     */
    public function do_del(){
        $data['state']  = 'success';
        $data['message'] = '提交成功';
        $this->ajaxReturn($data);
    }
}