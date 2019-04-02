<?php

namespace Core;

class Request
{
    private $config;
    private $table;
    public $param;
    public $record = [];

    public function __construct($config, $param, $table)
    {
        $this->config = $config;
        $this->param = $param;
        $this->table = $table;
    }

    public static function tokenMatch($method)
    {
        if ('GET' === $method) {
            return true;
        }
        $token = Input::request('_csrf_token');

        return $token === csrf_token();
    }

    public function select()
    {
        $pdo = new \PDO("{$this->config['db']}:host={$this->config['host']};dbname={$this->config['dbname']}", $this->config['username'], $this->config['password']);
        $query = new Query("SELECT * FROM {$this->table} where id = :id", $pdo);
        $query->bind(':id', $this->param, \PDO::PARAM_INT);
        $this->record = $query->first();

        return $this;
    }
}
