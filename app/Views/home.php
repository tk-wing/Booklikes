<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ホーム</title>
</head>
<body>
    <p>ID: <?php h($id) ?></p>
    <p>NAME: <?php h($name) ?></p>
    <p>E-MAIL: <?php h($email) ?></p>
    <?php if(isset($api_key)){ ?>
        <p>API KEY: <?php e($api_key); ?></p>
        <form method="post">
            <?php http_method('patch'); ?>
            <?php csrf_field(); ?>
            <button type="submit">APIキーを再発行する。</button>
        </form>
    <?php }else{ ?>
        <p>APIキーは発行されていません。</p>
        <form method="post">
            <?php csrf_field(); ?>
            <button type="submit">APIキーを発行する。</button>
        </form>
    <?php } ?>
    <a href="/bookshelf">本棚</a><br>
    <a href="/logout">ログアウト</a>
</body>
</html>
