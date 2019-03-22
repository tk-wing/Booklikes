<?php

namespace App\Controllers;

use PDO;
use PDOException;
use Core\Controller;
use Core\Input;
use Core\Response;

class LogoutController extends Controller
{
    public function logout(){
        $_SESSION = [];
        session_destroy();
        return Response::redirect('login');
    }
}
