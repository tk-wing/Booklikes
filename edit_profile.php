<?php
    session_start();
    require('dbconnect.php');
    require('functions.php');

    if (!isset($_SESSION['BOOKLIKES'])) {
        header('Location: signin.php');
        exit();
    }

    $validations = [];

    $sql='SELECT * FROM `users` WHERE `id`=?';
    $stmt = $dbh->prepare($sql);
    $data = [$_SESSION['BOOKLIKES']['id']];
    $stmt->execute($data);
    $signin_user = $stmt->fetch(PDO::FETCH_ASSOC);

    $prof_sql='SELECT * FROM `profiles` WHERE `user_id`=?';
    $prof_stmt = $dbh->prepare($prof_sql);
    $prof_data = [$signin_user['id']];
    $prof_stmt->execute($prof_data);
    $profile = $prof_stmt->fetch(PDO::FETCH_ASSOC);

    $categories_sql='SELECT * FROM `categories`';
    $categories_stmt = $dbh->prepare($categories_sql);
    $categories_data = [];
    $categories_stmt->execute($categories_data);

    // プロフィール未作成の場合
    if ($profile == FALSE) {
        if(!empty($_POST)){
            $nickname = $_POST['nickname'];
            $comment = $_POST['comment'];
            $category_id = $_POST['category_id'];
            $name = $_POST['name'];


            // 名前の空チェック
            if($name == ''){
                $validations['name'] = 'blank';
            }

            // 新規プロフィール作成
            $prof_sql = "INSERT INTO `profiles` SET `user_id`=?, `nickname`=?, `comment`=?, `created`=NOW()";
            $prof_data = [$signin_user['id'], $nickname, $comment];
            $prof_stmt = $dbh->prepare($prof_sql);
            $prof_stmt->execute($prof_data);

            // 新規カテゴリー作成
            $user_category_sql = "INSERT INTO `user_categories` SET `user_id`=?, `category_id`=?, `created`=NOW()";
            $user_category_data = [$signin_user['id'], $category_id];
            $user_category_stmt = $dbh->prepare($user_category_sql);
            $user_category_stmt->execute($user_category_data);

                if (empty($validations)) {

                    // ユーザーテーブルの名前と画像の更新があった場合
                    if ($name != $signin_user['name'] && $_FILES['img_name']['name'] != '') {
                        $file_name = $_FILES['img_name']['name'];
                        $tmp_file = $_FILES['img_name']['tmp_name'];
                        $file_name = date('YmdHis') .$_FILES['img_name']['name'];
                        $destination = 'user_profile_img/'.$file_name;
                        move_uploaded_file($tmp_file, $destination);

                        $user_sql = "UPDATE `users` SET `name`=?, `img_name`=?, `updated`=NOW() WHERE `id` = ?";
                        $user_data = [$name, $file_name, $signin_user['id']];
                        $user_stmt = $dbh->prepare($user_sql);
                        $user_stmt->execute($user_data);
                    // 名前のみの更新
                    }elseif ($name != $signin_user['name']) {
                        $user_sql = "UPDATE `users` SET `name`=?, `updated`=NOW() WHERE `id` = ?";
                        $user_data = [$name, $signin_user['id']];
                        $user_stmt = $dbh->prepare($user_sql);
                        $user_stmt->execute($user_data);
                    // 画像のみの更新
                    }elseif ($_FILES['img_name']['name']!='') {
                        $file_name = $_FILES['img_name']['name'];
                        $tmp_file = $_FILES['img_name']['tmp_name'];
                        $file_name = date('YmdHis') .$_FILES['img_name']['name'];
                        $destination = 'user_profile_img/'.$file_name;
                        move_uploaded_file($tmp_file, $destination);

                        $user_sql = "UPDATE `users` SET `img_name`=?, `updated`=NOW() WHERE `id` = ?";
                        $user_data = [$file_name, $signin_user['id']];
                        $user_stmt = $dbh->prepare($user_sql);
                        $user_stmt->execute($user_data);
                    }
                    header('Location: mypage.php');
                    exit();
                }
            }
    // プロフィールが作成済みの場合
    }else{
        $user_categories_sql='SELECT * FROM `user_categories` WHERE `user_id`=?';
        $user_categories_stmt = $dbh->prepare($user_categories_sql);
        $user_categories_data = [$signin_user['id']];
        $user_categories_stmt->execute($user_categories_data);

        $user_category = $user_categories_stmt->fetch(PDO::FETCH_ASSOC);


        if (!empty($_POST)) {
            $nickname = $_POST['nickname'];
            $comment = $_POST['comment'];
            $category_id = $_POST['category_id'];
            $name = $_POST['name'];

            // 名前の空チェック
            if($name == ''){
                $validations['name'] = 'blank';
            }

            // プロフィール更新
            $prof_sql = 'UPDATE `profiles` SET `nickname`=?, `comment`=?, `updated`=NOW() WHERE `user_id`=?';
            $prof_data = [$nickname, $comment, $signin_user['id']];
            $prof_stmt = $dbh->prepare($prof_sql);
            $prof_stmt->execute($prof_data);

            if($category_id != $user_category['category_id']){
                $user_categories_sql = 'UPDATE `user_categories` SET `category_id`=?, `updated`=NOW() WHERE `id` = ?';
                $user_categories_data = [$category_id, $user_category['id']];
                $user_categories_stmt = $dbh->prepare($user_categories_sql);
                $user_categories_stmt->execute($user_categories_data);
            }

            if (empty($validations)) {

                // ユーザーテーブルの名前と画像の更新があった場合
                if ($name != $signin_user['name'] && $_FILES['img_name']['name'] != '') {
                    $file_name = $_FILES['img_name']['name'];
                    $tmp_file = $_FILES['img_name']['tmp_name'];
                    $file_name = date('YmdHis') .$_FILES['img_name']['name'];
                    $destination = 'user_profile_img/'.$file_name;
                    move_uploaded_file($tmp_file, $destination);

                    $user_sql = "UPDATE `users` SET `name`=?, `img_name`=?, `updated`=NOW() WHERE `id` = ?";
                    $user_data = [$name, $file_name, $signin_user['id']];
                    $user_stmt = $dbh->prepare($user_sql);
                    $user_stmt->execute($user_data);
                // 名前のみの更新
                }elseif ($name != $signin_user['name']) {
                    $user_sql = "UPDATE `users` SET `name`=?, `updated`=NOW() WHERE `id` = ?";
                    $user_data = [$name, $signin_user['id']];
                    $user_stmt = $dbh->prepare($user_sql);
                    $user_stmt->execute($user_data);
                // 画像のみの更新
                }elseif ($_FILES['img_name']['name']!='') {
                    $file_name = $_FILES['img_name']['name'];
                    $tmp_file = $_FILES['img_name']['tmp_name'];
                    $file_name = date('YmdHis') .$_FILES['img_name']['name'];
                    $destination = 'user_profile_img/'.$file_name;
                    move_uploaded_file($tmp_file, $destination);

                    $user_sql = "UPDATE `users` SET `img_name`=?, `updated`=NOW() WHERE `id` = ?";
                    $user_data = [$file_name, $signin_user['id']];
                    $user_stmt = $dbh->prepare($user_sql);
                    $user_stmt->execute($user_data);
                }
                header('Location: mypage.php');
                exit();
            }
        }
    }




?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="ja"> <!--<![endif]-->
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>プロフィール編集</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Free HTML5 Website Template by FreeHTML5.co" />
  <meta name="keywords" content="free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
  <meta name="author" content="FreeHTML5.co" />

    <!--
  //////////////////////////////////////////////////////

  FREE HTML5 TEMPLATE
  DESIGNED & DEVELOPED by FreeHTML5.co

  Website:    http://freehtml5.co/
  Email:      info@freehtml5.co
  Twitter:    http://twitter.com/fh5co
  Facebook:     https://www.facebook.com/fh5co

  //////////////////////////////////////////////////////
  -->

    <!-- Facebook and Twitter integration -->
  <meta property="og:title" content=""/>
  <meta property="og:image" content=""/>
  <meta property="og:url" content=""/>
  <meta property="og:site_name" content=""/>
  <meta property="og:description" content=""/>
  <meta name="twitter:title" content="" />
  <meta name="twitter:image" content="" />
  <meta name="twitter:url" content="" />
  <meta name="twitter:card" content="" />

  <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
  <link rel="shortcut icon" href="favicon.ico">

  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">
  <link rel="stylesheet" href="css/stylesheet.css">

  <!-- Animate.css -->
  <link rel="stylesheet" href="css/animate.css">
  <!-- Icomoon Icon Fonts-->
  <link rel="stylesheet" href="css/icomoon.css">
  <!-- Bootstrap  -->
  <link rel="stylesheet" href="css/bootstrap.css">
  <!-- Flexslider  -->
  <link rel="stylesheet" href="css/flexslider.css">
  <!-- Theme style  -->
  <link rel="stylesheet" href="css/style.css">

  <!-- Modernizr JS -->
  <script src="js/modernizr-2.6.2.min.js"></script>
  <!-- FOR IE9 below -->
  <!--[if lt IE 9]>
  <script src="js/respond.min.js"></script>
  <![endif]-->

  <!-- jQuery読み込み -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

  <script>
  $(function(){
    $('#filesend').change(function(e){
      //ファイルオブジェクトを取得する
      var file = e.target.files[0];
      var reader = new FileReader();

      //画像でない場合は処理終了
      if(file.type.indexOf("image") < 0){
        alert("画像ファイルを指定してください。");
        return false;
      }

      //アップロードした画像を設定する
      reader.onload = (function(file){
        return function(e){
          $("#img1").attr("src", e.target.result);
          $("#img1").attr("title", file.name);
        };
      })(file);
      reader.readAsDataURL(file);

    });
  });
  </script>

  </head>
  <body>
  <div id="fh5co-page">
    <a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle"><i></i></a>
    <aside id="fh5co-aside" role="complementary" class="border js-fullheight">

      <h1 id="fh5co-logo"><a href="index.php">BookLikes</a></h1>
      <nav id="fh5co-main-menu" role="navigation">
        <ul>
          <li class="fh5co-active"><a href="mypage.php">マイページ</a></li>
          <li><a href="my_books.php">自分の投稿</a></li>
          <li><a href="feeds.php">すべての投稿一覧</a></li>
        </ul>
            </nav>

            <div class="fh5co-footer">
              <a href="signout.php"><button type="button" class="btn btn-danger">ログアウト</button></a>
              <p><small>&copy; 2016 Blend Free HTML5. All Rights Reserved.</span> <span>Designed by <a href="http://freehtml5.co/" target="_blank">FreeHTML5.co</a> </span> <span>Demo Images: <a href="https://unsplash.com/" target="_blank">Unsplash</a></span></small></p>
<!--               <ul>
                <li><a href="#"><i class="icon-facebook2"></i></a></li>
                <li><a href="#"><i class="icon-twitter2"></i></a></li>
                <li><a href="#"><i class="icon-instagram"></i></a></li>
                <li><a href="#"><i class="icon-linkedin2"></i></a></li>
              </ul> -->
            </div>

          </aside>

    <div id="fh5co-main">
      <div class="fh5co-narrow-content text-center">
        <legend><?php echo h($signin_user['name']) ?>さんのプロフィール編集</legend>
        <div class="edit_wrapper">
          <div>
            <form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-4" style="padding-left: 200px;">
                  <img id="img1" src="user_profile_img/<?php echo $signin_user['img_name'] ?>" style="width:160px;height:160px;border-radius: 50%;"><br>
                  <label>
                    <span class="filelabel" title="ファイルを選択">
                      選択
                    </span>
                    <input type="file" class="filesend" id="filesend" name="img_name" accept="image/*" style="display: none;">
                  </label>
                </div>

                <div class="col-md-8 text-left">
                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-md-3 control-label">お名前</label>
                    <div class="col-md-6">
                    <input id="name" name="name" type="text" placeholder="お名前" value='<?php echo h($signin_user['name']) ?>'class="form-control input-md">
                    <span class="error_msg"><?php echo result($validations, 'name', 'お名前') ?></span>
                    </div>
                  </div>

                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-md-3 control-label">ニックネーム(任意)</label>
                    <div class="col-md-6">
                    <input id="nickname" name="nickname" type="text" placeholder="ニックネーム(任意)" value="<?php echo h($profile['nickname']) ?>" class="form-control input-md">
                    </div>
                  </div>
                  <!-- Text input-->
                  <div class="form-group">
                    <label class="col-md-3 control-label">好きな本のジャンル<br>(任意)</label>
                    <div class="col-md-6">
                      <select id="category_id" name="category_id" class="form-control">
                        <option value="">選択してください</option>
                        <?php while (1) :?>
                          <?php $categories = $categories_stmt->fetch(PDO::FETCH_ASSOC); ?>
                          <?php if ($categories == FALSE): ?>
                            <?php break; ?>
                          <?php endif; ?>
                            <?php if ($categories['id'] == $user_category['category_id']): ?>
                              <option value="<?php echo $categories['id'] ?>" selected><?php echo $categories['category'] ?></option>
                            <?php else: ?>
                            <option value="<?php echo $categories['id'] ?>"><?php echo $categories['category'] ?></option>
                            <?php endif ?>
                        <?php endwhile ?>
                       </select>
                       <span class="error_msg"><?php echo select_result($validations, 'category_id', '本のジャンル') ?></span>
                    </div>
                  </div>
                  <!-- Textarea -->
                  <div class="form-group">
                    <label class="col-md-3 control-label">自己紹介＆メッセージ(任意)</label>
                    <div class="col-md-8">
                      <textarea class="form-control" id="comment" name="comment" placeholder="自己紹介＆メッセージ(任意)" style="height: 200px;"><?php echo h($profile['comment']) ?></textarea>
                    </div>
                  </div>
                </div>
              </div>
              <input type="submit" class="btn btn-success" value="完了">
            </form>
          </div>
        </div>
      </div>


    </div>
  </div>

  <!-- jQuery -->
  <script src="js/jquery.min.js"></script>
  <!-- jQuery Easing -->
  <script src="js/jquery.easing.1.3.js"></script>
  <!-- Bootstrap -->
  <script src="js/bootstrap.min.js"></script>
  <!-- Waypoints -->
  <script src="js/jquery.waypoints.min.js"></script>
  <!-- Flexslider -->
  <script src="js/jquery.flexslider-min.js"></script>


  <!-- MAIN JS -->
  <script src="js/main.js"></script>
  <script src="js/app.js"></script>

  </body>
</html>

