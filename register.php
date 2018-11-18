<?php
    require_once("dbconnect.php");
    require('functions.php');

    $name = $_POST['name'];
    $email = $_POST['email'];
    $pw = $_POST['pw'];
    $img_name = $_POST['img_name'];

    $sql='SELECT * FROM `users` WHERE `email`=?';
    $stmt = $dbh->prepare($sql);
    $data = [$email];
    $stmt->execute($data);
    $record = $stmt->fetch(PDO::FETCH_ASSOC);

    if($email != $record['email']){
        $sql = "INSERT INTO `users` SET `name`=?, `email`=?, `password`=?, `img_name`=?, `created`=NOW()";
        $data = [$name, $email, $pw, $img_name];
        $stmt = $dbh->prepare($sql);
        $res = $stmt->execute($data);
        echo json_encode($res);
    }

    unset($_SESSION['BOOKLIKES']);

 ?>