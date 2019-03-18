<?php

namespace Core;

class Action{
    public $class;
    public $action;

    public function __construct($class, $action){
        $this->class = $class;
        $this->action = $action;
    }

}
