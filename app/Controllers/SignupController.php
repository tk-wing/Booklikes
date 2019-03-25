<?php

namespace App\Controllers;

use PDO;
use PDOException;
use Core\Controller;
use Core\Input;
use Core\Response;

class SignupController extends Controller
{
    public function show()
    {
        // return Response::redirect('/');

        // return Response::json(['hoge' => 'piyo']);

        return Response::view('signup', [
            'hogehoge' => 'fugafuga',
        ]);
        // return Response::view('signup')->with();
        // return Response::with()->view();
    }

    public function register()
    {
        $name = Input::request('name');
        $email = Input::request('email');
        $password = Input::request('password');

        $date = date('Y-m-d H:i:s');

        $password = password_hash($password, PASSWORD_DEFAULT);

        $query = $this->query('insert into users (name, email, password, created_at, updated_at) value (:name, :email, :password, :created_at, :updated_at)');
        $query->bind(':name', $name, PDO::PARAM_STR);
        $query->bind(':email', $email, PDO::PARAM_STR);
        $query->bind(':password', $password, PDO::PARAM_STR);
        $query->bind(':created_at', $date, PDO::PARAM_STR);
        $query->bind(':updated_at', $date, PDO::PARAM_STR);
        $query->execute();

        return Response::redirect('login');
    }
}
