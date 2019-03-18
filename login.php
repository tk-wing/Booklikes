<?php
session_start();

$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

try{
    $pdo = new PDO('mysql:host=localhost;dbname=booklikes', 'booklikes', '1234');
    $statement = $pdo->prepare("select * from users where email = :email");
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();
    $record = $statement->fetch();
}catch(PDOException $e){
    echo $e->getMessage().PHP_EOL;
}

if(password_verify($password, $record['password'])){
    $_SESSION['id'] = $record['id'];
    header('Location: home.php');
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ログイン</title>
</head>

<body>
    <form method="post">
        <p>Eメールアドレス：<br><input name="email" type="text"></p>
        <p>パスワード：<br><input name="password" type="password"></p>
        <button type="submit">ログイン</button>
    </form>
</body>

</html>
