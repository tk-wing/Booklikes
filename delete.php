<?php
    require('functions.php');
    require('dbconnect.php');

    $feed_id = $_GET['feed_id'];


    $sql = "DELETE FROM `feeds` WHERE `id`=?";
    $stmt = $dbh->prepare($sql);
    $data = [$feed_id];
    $stmt->execute($data);

    header("Location: my_books.php");
    exit();


?>