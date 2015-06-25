<?php
/**
 * Created by PhpStorm.
 * User: KU04PC
 * Date: 2015/5/16
 * Time: 15:55
 */

namespace Admin\Logic;


class ManagerAccountLogic extends BaseLogic{

    /**
     * @var \Admin\Data\ManagerAccountData
     */
    protected $managerAccountData;

    public function _initialize(){
        $this->managerAccountData = D('ManagerAccount', 'Data');
    }

    /**
     * 获取单条数据
     * @param $id
     * @return mixed
     */
    public function getById($id){
        return $this->managerAccountData->getById($id);
    }

    /**
     * 获取多条数据
     * @param $conditions
     * @param null $pagePara
     * @return mixed
     */
    public function getList($conditions,$pagePara = null){
        return $this->managerAccountData->getList($conditions,$pagePara);
    }

    /**
     * 添加数据
     * @param $data
     * @return bool
     */
    public function saveManagerAccount($data){

        $ManagerAccount = D('ManagerAccount');

        if($ManagerAccount->create($data)){
            return $ManagerAccount->add();
        }else{
            return false;
        }
    }

    /**
     * 修改数据
     * @param $data
     * @return bool
     */
    public function editManagerAccount($data){
        $ManagerAccount = D('ManagerAccount');

        if($ManagerAccount->create($data)){
            return $ManagerAccount->save();
        }else{
            return false;
        }
    }

    /**
     * 删除数据
     * @param $id
     * @return mixed
     */
    public function delManagerAccount($id){
        $ManagerAccount = D('ManagerAccount');

        return $ManagerAccount->delete($id);
    }

}