<?php
/**
 * Created by PhpStorm.
 * User: KU04PC
 * Date: 2015/5/6
 * Time: 21:13
 */
namespace Admin\Controller;


use Admin\Enum\MenuStatusEnum;

class MenuController extends BaseController{

    /**
     * @var \Admin\Logic\MenuLogic
     */
    protected $menuLogic;

    public function _initialize(){
        $this->menuLogic = D('Menu', 'Logic');
    }

    /**
     * 数据列表
     */
    public function index(){
        $conditions = $this->getAvailableData();
        $pagePara = get_page_para();
        $menuList = $this->menuLogic->getList($conditions,$pagePara);


        $this->assign("list",$menuList['items']);
        $this->assign("pager",$menuList['pager']);
        $this->assign("params",$conditions);
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
    public function edit($id){
        $menuStatus = MenuStatusEnum::getConstants();

        $this->display();
    }

    /**
     * 查看视图
     */
    public function detail($id){
        $menu = $this->menuLogic->getById($id);

        $this->assign("menu",$menu);
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
    public function do_del($id){
        $result = $this->menuLogic->delMenu($id);

        $this->ajaxAuto($result,'删除');
    }
}