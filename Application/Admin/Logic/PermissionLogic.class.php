<?php
/**
 * Created by PhpStorm.
 * User: KU04PC
 * Date: 2015/5/16
 * Time: 15:55
 */

namespace Admin\Logic;


class PermissionLogic extends BaseLogic{

    /**
     * @var \Admin\Data\PermissionData
     */
    protected $permissionData;

    public function _initialize(){
        $this->permissionData = D('Permission', 'Data');
    }

    /**
     * 获取单条数据
     * @param $id
     * @return mixed
     */
    public function getById($id){
        return $this->permissionData->getById($id);
    }

    /**
     * 获取多条数据
     * @param $conditions
     * @param null $pagePara
     * @return mixed
     */
    public function getList($conditions,$pagePara = null){
        return $this->permissionData->getList($conditions,$pagePara);
    }

    /**
     * 添加数据
     * @param $data
     * @return bool
     */
    public function savePermission($data){

        $Permission = D('Permission');

        if($Permission->create($data)){
            return $Permission->add();
        }else{
            return false;
        }
    }

    /**
     * 修改数据
     * @param $data
     * @return bool
     */
    public function editPermission($data){
        $Permission = D('Permission');

        if($Permission->create($data)){
            return $Permission->save();
        }else{
            return false;
        }
    }

    /**
     * 删除数据
     * @param $id
     * @return mixed
     */
    public function delPermission($id){
        $Permission = D('Permission');

        return $Permission->delete($id);
    }

    /**
     * 根据模块名获取权限列表
     * @param $module
     * @return mixed
     */
    public function getPermissionsByModule($module){
        return $this->permissionData->getPermissionsByModule($module);
    }


    /**
     * 权限分组
     * @return array
     */
    public function getModules(){
        return array(
            "地址管理"	=> "address",
            "配置管理"	=> "config",
            "菜谱管理"	=> "cookbook",
            "送餐管理"	=> "delivery",
            "菜品管理"	=> "item",
            "日志管理"	=> "log",
            "管理员管理"	=> "manager_account",
            "菜单管理"	=> "menu",
            "订单管理"	=> "order",
            "支付管理"	=> "payment",
            "权限管理"	=> "permission",
            "角色管理"	=> "role",
            "用户管理"	=> "user"
        );
    }

}