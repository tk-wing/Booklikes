<?php

namespace App\Controllers;

use PDO;
use Core\Controller;
use Core\Response;

class HomeController extends Controller
{
    public function show()
    {
        $id = $_SESSION['id'];

        $query = $this->query('SELECT users.*, api_keys.api_key FROM users LEFT JOIN api_keys ON users.id = api_keys.user_id WHERE users.id = :id');
        $query->bind(':id', $id, PDO::PARAM_INT);
        $result = $query->first();

        return Response::view('home', $result);
    }

    public function create()
    {
        $id = $_SESSION['id'];
        $date = new \DateTime();
        $api = uniqid(mt_rand(), true);
        $api = hash('sha256', $api);

        $query = $this->query('insert into api_keys (user_id, api_key, created_at, updated_at, expired_at, scope) value(:user_id, :api_key, :created_at, :updated_at, :expired_at, :scope)');
        $query->bind(':user_id', $id, PDO::PARAM_INT);
        $query->bind(':api_key', $api, PDO::PARAM_STR);
        $query->bind(':created_at', $date->format('Y-m-d H:i:s'), PDO::PARAM_STR);
        $query->bind(':updated_at', $date->format('Y-m-d H:i:s'), PDO::PARAM_STR);
        $query->bind(':expired_at', $date->modify('+1 days')->format('Y-m-d H:i:s'), PDO::PARAM_STR);
        $query->bind(':scope', '*', PDO::PARAM_STR);
        $query->execute();

        return Response::redirect('home');
    }

    public function update()
    {
        $id = $_SESSION['id'];
        $date = new \DateTime();
        $api = uniqid(mt_rand(), true);
        $api = hash('sha256', $api);

        $query = $this->query("UPDATE api_keys SET api_key = :api_key, updated_at = :updated_at, expired_at = :expired_at WHERE user_id = :id");
        $query->bind(':api_key', $api, PDO::PARAM_STR);
        $query->bind(':updated_at', $date->format('Y-m-d H:i:s'), PDO::PARAM_STR);
        $query->bind(':expired_at', $date->modify('+1 days')->format('Y-m-d H:i:s'), PDO::PARAM_STR);
        $query->bind(':id', $id, PDO::PARAM_INT);
        $query->execute();

        return Response::redirect('home');
    }
}
