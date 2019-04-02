<?php

namespace Core\Model;

class User
{
    public $id;

    public function __construct($userId)
    {
        $this->id = $userId;
    }
}
