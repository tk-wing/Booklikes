<?php

namespace Core\Response;

class ViewResponse{
    private $name;
    private $value = [];

    public function __construction($name){
        $this->name = $name;
    }
}
