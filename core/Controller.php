<?php

namespace Core;

class Controller{

    private $name;
    private $values = [];

    public function view($name, $values = []){
        $this->name = $name;
        $this->values = $values;

        return $this;
    }

    public function with($values){
        $this->values = $values;

        return $this;
    }

    public function render() {
        foreach($this->values as $key => $value){
            $$key = $value;
        }
        require __DIR__."/../app/Views/{$this->name}.php";
    }
}
