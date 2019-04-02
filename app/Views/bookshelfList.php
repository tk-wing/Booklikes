<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>本棚</title>
</head>

<body>
    <form method="post">
        <?php csrf_field();?>
        <p>本棚名：<input name="title" type="text"></p>
        <ul>
            <?php foreach($errors['title'] ?? [] as $error) {?>
                <li><?php echo $error; ?></li>
            <?php };?>
        </ul>
        <button type="submit">本棚作成</button>
    </form>
    <?php if($bookshelves) { ?>
        <?php foreach ($bookshelves as $bookshelf){ ?>
            <form action="/bookshelf/<?php h($bookshelf['id'])?>" method="post">
                <?php csrf_field() ?>
                <?php http_method('delete'); ?>
                <a href="/bookshelf/<?php h($bookshelf['id']) ?>"><?php h($bookshelf['title']) ?></a><br>
                <button type="submit">本棚を削除</button><br>
            </form>
        <?php } ?>
    <?php }else{ ?>
        <p>本棚がありません。</p>
    <?php } ?>
    <a href="/home">ホーム</a>
    <a href="/logout">ログアウト</a>
</body>

</html>
