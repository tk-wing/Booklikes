<?php
    session_start();
    require('dbconnect.php');
    require('functions.php');

    if (!isset($_SESSION['BOOKLIKES'])) {
        header('Location: signin.php');
        exit();
    }

    // ユーザー情報・ユーザープロフィール情報を取得
    $sql='SELECT `u`.*, `p`.`nickname`, `p`.`comment` FROM `users` AS `u` LEFT JOIN `profiles` AS `p` ON `u`.`id` = `p`.`user_id` WHERE `u`.`id`=?';
    $stmt = $dbh->prepare($sql);
    $data = [$_SESSION['BOOKLIKES']['id']];
    $stmt->execute($data);
    $signin_user = $stmt->fetch(PDO::FETCH_ASSOC);

    // ユーザーカテゴリ情報を取得
    $user_categories_sql='SELECT * FROM `user_categories`';
    $user_categories_stmt = $dbh->prepare($user_categories_sql);
    $user_categories_data = [];
    $user_categories_stmt->execute($user_categories_data);

    while (1) {
        $user_categories = $user_categories_stmt->fetch(PDO::FETCH_ASSOC);
        if ($user_categories==FALSE) {
            break;
        }
        if ($user_categories['user_id'] == $signin_user['id']) {
            $user_categories_sql='SELECT * FROM `categories` WHERE `id`=?';
            $user_categories_stmt = $dbh->prepare($user_categories_sql);
            $user_categories_data = [$user_categories['category_id']];
            $user_categories_stmt->execute($user_categories_data);
            $user_category = $user_categories_stmt->fetch(PDO::FETCH_ASSOC);
        }
    }

    // セレクトタグで表示のため取得
    $categories_sql='SELECT * FROM `categories`';
    $categories_stmt = $dbh->prepare($categories_sql);
    $categories_data = [];
    $categories_stmt->execute($categories_data);

    $validations = [];

    $category_id = '';
    $title = '';
    $comment = '';

    if(!empty($_POST)){
        $category_id = $_POST['category_id'];
        $title = $_POST['title'];
        $comment = $_POST['comment'];

        if($category_id == ''){
            $validations['category_id'] = 'blank';
        }

        if($title == ''){
            $validations['title'] = 'blank';
        }

        if($comment == ''){
            $validations['comment'] = 'blank';
        }

        $file_name = $_FILES['img_name']['name'];
        if($file_name==''){
            $validations['img_name'] = 'blank';
        }

        if(empty($validations)){
            $tmp_file = $_FILES['img_name']['tmp_name'];
            $file_name = date('YmdHis') .$_FILES['img_name']['name'];
            $destination = 'book_img/'.$file_name;
            move_uploaded_file($tmp_file, $destination);

            $sql = "INSERT INTO `feeds` SET `user_id`=?, `category_id`=?, `title`=?, `comment`=?, `img_name`=?, `created`=NOW()";
            $stmt = $dbh->prepare($sql);
            $data = [$signin_user['id'], $category_id, $title, $comment, $file_name];
            $stmt->execute($data);

            header('Location: my_books.php');
            exit();
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
  <title>マイページ</title>
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
        <?php if ($signin_user['nickname']==''): ?>
          <legend><?php echo h($signin_user['name']) ?>さんのマイページ</legend>
        <?php else: ?>
          <legend><?php echo h($signin_user['nickname']) ?>さんのマイページ</legend>
        <?php endif ?>
        <div class="mypage_wrapper">
          <div class="row">
            <div class="col-md-5 text-center">
              <img src="user_profile_img/<?php echo $signin_user['img_name'] ?>" alt="Blog" style="width:140px;height:140px;border-radius: 50%;"><br>
            </div>
            <div class="col-md-7">
              <div>
                ＜好きな本のジャンル＞
                <?php if (isset($user_category)): ?>
                  <p><?php echo h($user_category['category']) ?></p>
                <?php else: ?>
                  <p></p>
                <?php endif ?>
              </div>
              <div>
                ＜自己紹介＆メッセージ＞
                <p><?php echo h($signin_user['comment']) ?></p>
              </div>
            </div>
          </div>
          <a href="edit_profile.php"><button type="button" class="btn btn-success">プロフィール編集</button></a>
        </div>

        <legend>おすすめ書籍を投稿する</legend>
        <div class="feed_wrapper">
          <form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-4" style="padding-left: 100px;">
                <img id="img1" src="https://placehold.jp/300x200.png" style="width:300px;height:200px;"><br>
                <label>
                  <span class="filelabel" title="ファイルを選択">
                    選択
                  </span>
                  <input type="file" class="filesend" id="filesend" name="img_name" accept="image/*" style="display: none;">
                </label><br>
                  <?php if (isset($validations['img_name']) && $validations['img_name'] == 'blank') :?>
                  <span class="error_msg">画像を選択してください。</span>
                <?php endif ?>
              </div>
              <div class="col-md-8 text-left">

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-3 control-label">本のタイトル</label>
                  <div class="col-md-6">
                  <input id="title" name="title" type="text" placeholder="本のタイトル" value="<?php echo h($title) ?>" class="form-control input-md">
                    <span class="error_msg"><?php echo result($validations, 'title', '本のタイトル') ?></span>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-3 control-label">本のジャンル</label>
                  <div class="col-md-6">
                    <select id="category_id" name="category_id" class="form-control">
                      <option value="">選択してください</option>
                      <?php while (1) :?>
                        <?php $categories = $categories_stmt->fetch(PDO::FETCH_ASSOC); ?>
                        <?php if ($categories == FALSE): ?>
                          <?php break; ?>
                        <?php endif; ?>
                          <?php if ($categories['id']== $category_id): ?>
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
                  <label class="col-md-3 control-label">おすすめの理由</label>
                  <div class="col-md-8">
                    <textarea class="form-control" id="comment" name="comment" placeholder="おすすめの理由" style="height: 200px;"><?php echo h($comment) ?></textarea>
                    <span class="error_msg"><?php echo result($validations, 'comment', 'おすすめの理由') ?></span>
                  </div>
                </div>
              </div>
            </div>
            <input type="submit" class="btn btn-success" value="投稿">
          </form>
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

  </body>
</html>

