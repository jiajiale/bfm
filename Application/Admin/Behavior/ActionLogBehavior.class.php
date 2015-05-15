<?php

namespace Admin\Behavior;
use Think\Behavior;

class ActionLogBehavior extends Behavior {

    public function run(&$content){
        $uri = I('param.');
    }
}