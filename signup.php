<?php
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

$date = date('Y-m-d H:i:s');

$password = password_hash($password, PASSWORD_DEFAULT);

try{
    $pdo = new PDO('mysql:host=localhost;dbname=booklikes', 'booklikes', '1234');
    $statement = $pdo->prepare("insert into users (name, email, password, created_at, updated_at) value (:name, :email, :password, :created_at, :updated_at)");
    $statement->bindParam(':name', $name, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':password', $password, PDO::PARAM_STR);
    $statement->bindParam(':created_at', $date, PDO::PARAM_STR);
    $statement->bindParam(':updated_at', $date, PDO::PARAM_STR);
    $statement->execute();
}catch(PDOException $e){
    echo $e->getMessage().PHP_EOL;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>新規登録</title>
</head>

<body>
    <form method="post">
        <p>名前：<br><input name="name" type="text"></p>
        <p>Eメールアドレス：<br><input name="email" type="text"></p>
        <p>パスワード：<br><input name="password" type="password"></p>
        <button type="submit">登録</button>
    </form>
</body>

</html>
