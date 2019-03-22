<?php

namespace App\Controllers;

use PDO;
use PDOException;
use Core\Controller;
use Core\Response;

class HomeController extends Controller
{
    public function show()
    {
        $id = $_SESSION['id'];

        $query = $this->query('select * from users where id = :id');
        $query->bind(':id', $id, PDO::PARAM_INT);
        $result = $query->first();

        return Response::view('home', $result);
    }
}
