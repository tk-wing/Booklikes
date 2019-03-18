<?php
session_start();
$id = $_SESSION["id"] ?? '';

if(!$id){
    header("Location: login.php");
    exit();
}

echo $id.PHP_EOL;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
    <a href="./logout.php">ログアウト</a>
</body>
</html>
