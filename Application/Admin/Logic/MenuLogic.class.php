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

    public function getList($conditions,$pageBounds = null){
        return $this->menuData->getList($conditions,$pageBounds);
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
}