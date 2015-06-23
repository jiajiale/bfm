<?php
/**
 * Created by PhpStorm.
 * User: KU04PC
 * Date: 2015/5/6
 * Time: 21:13
 */
namespace Admin\Controller;



class RoleController extends BaseController{


    /**
     * @var \Admin\Logic\RoleLogic
     * @var \Admin\Logic\PermissionLogic
     */
    protected $roleLogic;
    protected $permissionLogic;
    protected $rolePermissionRelationLogic;

    public function _initialize(){
        $this->roleLogic = D('Role', 'Logic');
        $this->permissionLogic = D('Permission', 'Logic');
        $this->rolePermissionRelationLogic = D('RolePermissionRelation', 'Logic');
    }


    /**
     * 数据列表
     */
    public function index(){
        $conditions = $this->getAvailableData();
        $pagePara = get_page_para();
        $roleList = $this->roleLogic->getList($conditions,$pagePara);

        $this->assign("list",$roleList['items']);
        $this->assign("pager",$roleList['pager']);
        $this->assign("params",$conditions);
        $this->display();
    }

    /**
     * 添加视图
     */
    public function add(){
        $modules = $this->permissionLogic->getModules();
        $modules_list = array();

        foreach($modules as $key => $val){
            $modules_list[] = array(
                'module_key'  => $key,
                'module_val'  => $val,
                'permissions' => $this->permissionLogic->getPermissionsByModule($val)
            );
        }

        $this->assign('modules_list',$modules_list);
        $this->display();
    }

    /**
     * 编辑视图
     */
    public function edit($id){
        $role_permissions = array_column(
            $this->rolePermissionRelationLogic->getRolePermissions($id),'permission_id');

        $modules = $this->permissionLogic->getModules();

        $modules_list = array();

        foreach($modules as $key => $val){
            $permissions = $this->permissionLogic->getPermissionsByModule($val);

            foreach($permissions as $itemKey => $itemVal){
                if(in_array($itemVal['id'],$role_permissions)){
                    $permissions[$itemKey]['checked'] = true;
                }else{
                    $permissions[$itemKey]['checked'] = false;
                }
            }

            $modules_list[] = array(
                'module_key'  => $key,
                'module_val'  => $val,
                'permissions' => $permissions
            );
        }

        $this->assign('modules_list',$modules_list);
        $this->display();
    }

    /**
     * 查看视图
     */
    public function detail($id){
        $role = $this->roleLogic->getById($id);

        $this->assign("permission",$role);
        $this->display();
    }

    /**
     * 添加操作
     */
    public function do_add(){
        $data = $this->getAvailableData();

        //$result = $this->permissionLogic->savePermission($data);

        //$this->ajaxAuto($result,'添加');
    }

    /**
     * 编辑操作
     */
    public function do_edit(){
        $data = $this->getAvailableData();
        $result = $this->permissionLogic->editPermission($data);

        $this->ajaxAuto($result,'修改');
    }

    /**
     * 删除操作
     */
    public function do_del($id){
        $result = $this->permissionLogic->delPermission($id);

        $this->ajaxAuto($result,'删除');
    }
}