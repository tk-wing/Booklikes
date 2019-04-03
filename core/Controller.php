<?php

namespace Core;

use Core\Model\User;

class Controller
{
    private $name;
    private $values = [];
    private $config;
    private $pdo;
    public $authorizedUser;
    private $isExpired;

    public function __construct($config)
    {
        $this->pdo = new \PDO("{$config['db']}:host={$config['host']};dbname={$config['dbname']}", $config['username'], $config['password']);
        $this->config = $config;

        // Authorization: Bearer a8e8add75676fa7b1bf47938deda1d1d92efc1b765e837c4f8abd6b726e27a1a

        $auth = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
        $auth = explode(' ', $auth);

        $apiKey = $auth[1] ?? '';

        $query = $this->query('SELECT * FROM api_keys WHERE api_key = :api_key');
        $query->bind(':api_key', $apiKey, \PDO::PARAM_STR);
        $result = $query->first();

        if ($result) {
            $expiredAt = new \DateTime($result['expired_at']);
            $now = new \DateTime();
            $this->isExpired = $expiredAt < $now;
            $this->authorizedUser = new User($result['user_id']);
        }
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
        return new Validation($requests, $fields, $this->pdo);
    }

    public function isAuthorized()
    {
        return (bool) $this->authorizedUser;
    }

    public function isExpired(){
        return $this->isExpired;
    }

    public function scope($scope)
    {
        $id = $this->authorizedUser->id;

        $query = $this->query('SELECT scope FROM api_keys WHERE user_id = :id');
        $query->bind(':id', $id, \PDO::PARAM_INT);
        $result = $query->first();

        $_scope = explode(',', $result['scope']);
        foreach ($_scope as $value) {
            if ('*' === $value) {
                return true;
            } elseif ($value === $scope) {
                return true;
            }
        }

        return false;
    }
}
