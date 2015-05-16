<?php

namespace Admin\Behavior;

use Common\Util\Validate;
use Think\Behavior;

class RequestValidateBehavior extends Behavior {

    public function run(&$content){
        $params = I('post.');

        if($params != null && count($params) > 0){
            $ruleClass =  '\\Admin\\Rules\\'.CONTROLLER_NAME.'Rule';
            $rules = $ruleClass::$_validate;

            $test = validate::test($params,$rules);

            if(is_array($test)){
                $data['state'] = 'fail';
                $data['message'] = current($test);
                header('Content-Type:application/json; charset=utf-8');
                exit(json_encode($data,0));
            }
        }

    }
}