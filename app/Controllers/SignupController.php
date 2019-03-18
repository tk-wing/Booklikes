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
        return Response::redirect('/hogehoge');

        // return Response::json(['hoge' => 'piyo']);

        return $this->view('signup');
        return $this->view('signup')->with();
        return $this->with()->view();
    }

    public function register()
    {
        $name = Input::post('name');
        $email = Input::post('email');
        $password = Input::post('password');

        $date = date('Y-m-d H:i:s');

        $password = password_hash($password, PASSWORD_DEFAULT);

        try {
            $pdo = new PDO('mysql:host=localhost;dbname=booklikes', 'booklikes', '1234');
            $statement = $pdo->prepare('insert into users (name, email, password, created_at, updated_at) value (:name, :email, :password, :created_at, :updated_at)');
            $statement->bindParam(':name', $name, PDO::PARAM_STR);
            $statement->bindParam(':email', $email, PDO::PARAM_STR);
            $statement->bindParam(':password', $password, PDO::PARAM_STR);
            $statement->bindParam(':created_at', $date, PDO::PARAM_STR);
            $statement->bindParam(':updated_at', $date, PDO::PARAM_STR);
            $statement->execute();
        } catch (PDOException $e) {
            echo $e->getMessage().PHP_EOL;
        }

        return Response::redirect('login');
    }
}
