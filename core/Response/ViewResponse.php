<?php

namespace Core\Response;

class ViewResponse
{
    private $name;
    private $values = [];

    public function view($name, $values = [])
    {
        if($values){
            $this->values = $values;
        }
        $this->name = $name;
        return $this;
    }

    public function with($values)
    {
        $this->values = $values;
        return $this;
    }

    public function render() {
        foreach($this->values as $key => $value){
            $$key = $value;
        }
        require __DIR__."/../../app/Views/{$this->name}.php";
    }
}
