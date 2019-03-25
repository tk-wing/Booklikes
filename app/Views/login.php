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
        <?php csrf_field(); ?>
        <?php if (isset($email)) {
    ?>
            <p>Eメールアドレス：<br><input name="email" type="text"
                value="<?php h($email); ?>"></p>
        <?php
} else {
        ?>
            <p>Eメールアドレス：<br><input name="email" type="text"></p>
        <?php
    } ?>
        <p>パスワード：<br><input name="password" type="password"></p>
        <?php if (isset($hasError)) {
        ?>
            <p>パスワードが一致しません。
            </p>
        <?php
    } ?>
        <button type="submit">ログイン</button>
    </form>
</body>

</html>
