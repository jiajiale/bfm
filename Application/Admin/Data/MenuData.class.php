<?php
/**
 * Created by PhpStorm.
 * User: KU04PC
 * Date: 2015/5/11
 * Time: 21:07
 */

namespace Admin\Data;


class MenuData extends BaseData{

    /**
     * 单条记录查找
     * @param $id
     * @return mixed
     */
    public function getById($id){
        return $this->table('__MENU__ AS menu')
                    ->field('menu.*')
                    ->where('id=%d',$id)
                    ->find();
    }

    /**
     * 多条记录查找
     * @param $conditions
     * @param $pageBounds
     * @return mixed
     */
    public function getList($conditions,$pageBounds){

        $where = array();

        if (isset($conditions['id'])) {
            $where['menu.id'] = array('EQ', $conditions['id']);
        }
        if (isset($conditions['title'])) {
            $where['menu.title'] = array('EQ', $conditions['title']);
        }
        if (isset($conditions['parent'])) {
            $where['menu.parent'] = array('EQ', $conditions['parent']);
        }
        if (isset($conditions['path'])) {
            $where['menu.path'] = array('EQ', $conditions['path']);
        }
        if (isset($conditions['grade'])) {
            $where['menu.grade'] = array('EQ', $conditions['grade']);
        }
        if (isset($conditions['url'])) {
            $where['menu.url'] = array('EQ', $conditions['url']);
        }
        if (isset($conditions['sort'])) {
            $where['menu.sort'] = array('EQ', $conditions['sort']);
        }
        if (isset($conditions['status'])) {
            $where['menu.status'] = array('EQ', $conditions['status']);
        }

        return $this->table('__MENU__ AS menu')
            ->field('menu.*')
            ->where($where)
            ->select();
    }

}