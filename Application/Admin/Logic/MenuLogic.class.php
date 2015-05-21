<?php
/**
 * Created by PhpStorm.
 * User: KU04PC
 * Date: 2015/5/16
 * Time: 15:55
 */

namespace Admin\Logic;

class MenuLogic extends BaseLogic{

    public function _initialize(){
        $this->menuData = D('Menu', 'Data');
    }

    /**
     * 获取单条数据
     * @param $id
     * @return mixed
     */
    public function getById($id){
        return $this->menuData->getById($id);
    }

    /**
     * 获取多条数据
     * @param $conditions
     * @param null $pagePara
     * @return mixed
     */
    public function getList($conditions,$pagePara = null){
        return $this->menuData->getList($conditions,$pagePara);
    }

    /**
     * 添加数据
     * @param $data
     * @return bool
     */
    public function saveMenu($data){

        $Menu = D('Menu');

        if($Menu->create($data)){
            $menuId = $Menu->add();
            $menu = $this->menuData->getById($menuId);

            if($menu['parent'] == 0){
                $menu['grade'] = 1;
                $menu['path'] = ',0,'.$menu['id'].',';
            }else{
                $parentMenu = $this->menuData->getById($menu['parent']);
                $menu['grade'] = $parentMenu['grade'] + 1;
                $menu['path'] = $parentMenu['path'].$menu['id'].',';
            }

            return $Menu->save($menu);
        }else{
            return false;
        }
    }

    /**
     * 修改数据
     * @param $data
     * @return bool
     */
    public function editMenu($data){
        return false;
    }

    /**
     * 删除数据
     * @param $id
     * @return mixed
     */
    public function delMenu($id){
        $Menu = D('Menu');

        return $Menu->delete($id);
    }
}