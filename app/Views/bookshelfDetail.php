<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>本一覧</title>
</head>
<body>
    <h1><?php h($title) ?></h1>
    <form action="/bookshelf/<?php h($id); ?>" method="post">
        <?php csrf_field(); ?>
        <?php http_method('patch'); ?>
        <input type="text" name="title">
        <button type="submit">本棚のタイトルを変更</button>
    </form>


    <form action=""></form>
    <a href="/home">ホーム</a>
    <a href="/bookshelf">本棚</a>
    <a href="/logout">ログアウト</a>
</body>
</html>
