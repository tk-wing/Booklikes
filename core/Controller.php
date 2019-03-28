<?php

namespace Core;

class Controller
{
    private $name;
    private $values = [];
    private $config;
    private $pdo;

    public function __construct($config)
    {
        $this->pdo = new \PDO("{$config['db']}:host={$config['host']};dbname={$config['dbname']}", $config['username'], $config['password']);
        $this->config = $config;
    }

    public function view($name, $values = [])
    {
        $this->name = $name;
        $this->values = $values;

        return $this;
    }

    public function with($values)
    {
        $this->values = $values;

        return $this;
    }

    public function render()
    {
        foreach ($this->values as $key => $value) {
            $$key = $value;
        }
        require __DIR__."/../app/Views/{$this->name}.php";
    }

    public function query($query)
    {
        return new Query($query, $this->pdo);
    }

    public function validation($requests, $fields)
    {
        return new Validation($requests, $fields);
    }
}
