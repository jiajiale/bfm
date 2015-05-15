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

    }

    public function index(){
        $this->display();
    }

    public function add(){
        $this->display();
    }
}