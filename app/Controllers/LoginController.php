<?php

namespace App\Controllers;

use PDO;
use PDOException;
use Core\Controller;
use Core\Input;
use Core\Response;

class LoginController extends Controller
{
    public function show()
    {
        return Response::view('login');
    }

    public function login()
    {

        $email = Input::request('email');
        $password = Input::request('password');

        $query = $this->query('select * from users where email = :email');
        $query->bind(':email', $email, PDO::PARAM_STR);
        $result = $query->first();

        if (password_verify($password, $result['password'])) {
            session_regenerate_id();
            $_SESSION['id'] = $result['id'];
            return Response::redirect('home');
        }else{
            $result = [
                'hasError' => true,
                'email' => $email
            ];
            return Response::view('login',$result);
        }
    }
}
