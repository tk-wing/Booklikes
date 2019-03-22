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
        <a href="/books?bookshelfId=<?php echo $bookshelf['id'] ?>"><?php h($bookshelf['title']) ?></a>
        <form action="/bookshelf/delete" method="post">
            <input type="hidden" name="bookshelfId" value="<?php echo $bookshelf['id'];?>">
            <button type="submit">本棚を削除</button>
        </form>
        <?php } ?>
    <?php }else{ ?>
        <p>本棚がありません。</p>
    <?php } ?>
    <a href="/home">ホーム</a>
    <a href="/logout">ログアウト</a>
</body>

</html>
