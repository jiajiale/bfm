<?php
namespace Admin\Controller;


class IndexController extends BaseController {

    /**
     * @var \Admin\Logic\MenuLogic
     */
    protected $menuLogic;

    public function _initialize(){
        $this->menuLogic = D('Menu','Logic');
    }

    public function index(){
        $menuTree = $this->menuLogic->getMenuTreeByRoleId(1);

        $this->assign('menuTree',$menuTree);
        $this->display();
    }


    public function left(){
        $this->display();
    }

    public function top(){
        $this->display();
    }


    public function main(){
        $this->display();
    }

}