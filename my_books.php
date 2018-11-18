<?php
    session_start();
    require('dbconnect.php');
    require('functions.php');

    if (!isset($_SESSION['BOOKLIKES'])) {
        header('Location: signin.php');
        exit();
    }

    // 登録者本人の投稿を取得
    $sql='SELECT * FROM `feeds` WHERE `user_id`=? ORDER BY `created` DESC';
    $stmt = $dbh->prepare($sql);
    $data = [$_SESSION['BOOKLIKES']['id']];
    $stmt->execute($data);

    $feeds= [];

    while (1) {
        $feed = $stmt->fetch(PDO::FETCH_ASSOC);
        if($feed == FALSE){
            break;
        }

        $categories_sql='SELECT * FROM `categories` WHERE `id`=?';
        $categories_stmt = $dbh->prepare($categories_sql);
        $categories_data = [$feed['category_id']];
        $categories_stmt->execute($categories_data);
        $categories = $categories_stmt->fetch(PDO::FETCH_ASSOC);

        $feed['category'] = $categories['category'];

        // いいねカウント
        $like_sql = "SELECT COUNT(*) AS `like_count` FROM likes WHERE `feed_id`=?";
        $like_data = [$feed['id']];
        $like_stmt = $dbh->prepare($like_sql);
        $like_stmt->execute($like_data);

        $like_count_data = $like_stmt->fetch(PDO::FETCH_ASSOC);
        $feed['like_count'] = $like_count_data['like_count'];

        $feeds[] = $feed;

    }

?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Books</title>
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
  <!-- FontAwesome読み込み -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">

  <!-- Modernizr JS -->
  <script src="js/modernizr-2.6.2.min.js"></script>
  <!-- FOR IE9 below -->
  <!--[if lt IE 9]>
  <script src="js/respond.min.js"></script>
  <![endif]-->

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
<!--         <ul>
          <li><a href="#"><i class="icon-facebook2"></i></a></li>
          <li><a href="#"><i class="icon-twitter2"></i></a></li>
          <li><a href="#"><i class="icon-instagram"></i></a></li>
          <li><a href="#"><i class="icon-linkedin2"></i></a></li>
        </ul> -->
      </div>

    </aside>

    <div id="fh5co-main">
      <div class="fh5co-narrow-content">
        <h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">My Books</h2>
        <div class="row row-bottom-padded-md">
          <?php foreach ($feeds as $feed): ?>
            <div class="col-md-3 col-sm-6 col-padding animate-box" data-animate-effect="fadeInLeft">
              <div class="blog-entry">
                <a href="#" data-toggle="modal" data-target="#demoNormalModal<?php echo $feed['id'] ?>"><img src="book_img/<?php echo $feed['img_name'] ?>" class="img-responsive" width="100%" style="height: 180px;" alt="Free HTML5 Bootstrap Template by FreeHTML5.co"></a>
                <div class="desc">
                  <h3 class="overflow"><?php echo h($feed['title']) ?></h3>
                  <span><small><?php echo h($feed['created']) ?></small></span>

                  <?php if ($feed['like_count'] == 0): ?>
                    <span style="display: inline-block;"><i class="far fa-heart"></i></span>
                  <?php else: ?>
                    <span style="display: inline-block;"><i style="color: red;" class="fas fa-heart"></i></span>
                  <?php endif ?>
                  <span class="like_count" style="display: inline-block; margin-left: 3px;"><?php echo $feed['like_count']?></span>
                  <span style="display: inline-block;">いいね</span><br>

                  <!-- <p>Design must be functional and functionality must be translated into visual aesthetics</p> -->
                  <a href="#" data-toggle="modal" data-target="#demoNormalModal<?php echo $feed['id'] ?>" class="lead">Read More <i class="icon-arrow-right3"></i></a><br>
                  <div class="text-center" style="margin-top: 8px;">
                  <a href="delete.php?feed_id=<?php echo $feed['id'] ?>" onclick="return confirm('この投稿を削除しますか？')"><button type="button" class="btn btn-danger">削除</button></a>
                  <a href="edit_feed.php?feed_id=<?php echo $feed['id'] ?>"><button type="button" class="btn btn-success">編集</button></a>
                  </div>
                </div>
              </div>
            </div>

              <!-- モーダルダイアログ -->
              <div class="modal fade" id="demoNormalModal<?php echo $feed['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header text-center">
                      <h3 class="modal-title" id="demoModalTitle"><?php echo h($feed['title']) ?></h3>
                      <p><?php echo $feed['category'] ?></p>
                    </div>
                    <div class="modal-body text-center">
                      <img src="book_img/<?php echo $feed['img_name'] ?>" class="img-responsive" width="100%" height="100%" alt="Free HTML5 Bootstrap Template by FreeHTML5.co">
                      <p class="nomal" style="font-size: 15px;"><?php echo h($feed['comment']) ?></p>
                    </div>
                    <div class="modal-footer text-center">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                      <!-- <button type="button" class="btn btn-primary">ボタン</button> -->
                    </div>
                  </div>
                </div>
              </div>

          <?php endforeach ?>


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

