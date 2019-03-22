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
        <p>本棚名：<input name="title" type="text"></p>
        <button type="submit">本棚作成</button>
    </form>
    <?php if($bookshelves) { ?>
        <?php foreach ($bookshelves as $bookshelf){ ?>
            <a href="/bookshelf/<?php h($bookshelf['id']) ?>"><?php h($bookshelf['title']) ?></a><br>
            <a href="/bookshelf/<?php h($bookshelf['id'])?>/delete"><button>本棚を削除</button></a><br>
        </form>
        <?php } ?>
    <?php }else{ ?>
        <p>本棚がありません。</p>
    <?php } ?>
    <a href="/home">ホーム</a>
    <a href="/logout">ログアウト</a>
</body>

</html>
