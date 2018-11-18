<?php
    session_start();
    require('dbconnect.php');
    require('functions.php');

    if (!isset($_SESSION['BOOKLIKES'])) {
        header('Location: signin.php');
        exit();
    }

    $name = $_SESSION['BOOKLIKES']['name'];
    $email = $_SESSION['BOOKLIKES']['email'];
    $pw = $_SESSION['BOOKLIKES']['password'];
    $file_name = $_SESSION['BOOKLIKES']['file_name'];

    $pw_c = strlen($pw);

 ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>登録内容確認</title>
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

  </head>
  <body>
  <div id="fh5co-page">
    <a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle"><i></i></a>
    <aside id="fh5co-aside" role="complementary" class="border js-fullheight">

      <h1 id="fh5co-logo"><a href="index.php">BookLikes</a></h1>
      <nav id="fh5co-main-menu" role="navigation">
        <ul>
          <li class="fh5co-active"><a href="index.php">Home</a></li>
          <li><a href="books.php">Books</a></li>
          <li><a href="signin.php">サインイン</a></li>
          <li><a href="signup.php">新規会員登録</a></li>
        </ul>
      </nav>

      <div class="fh5co-footer">
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
      <div class="fh5co-narrow-content text-center">

        <!-- Form Name -->
        <legend>ご登録をご確認ください。</legend>

        <div>
          <label class="control-label">お名前</label>
            <h3><?php echo h($name) ?></h3>
        </div>

        <div>
          <label class="control-label">メールアドレス</label>
            <h3><?php echo h($email) ?></h3>
        </div>

        <div>
          <label class="control-label">パスワード</label>
            <h3><?php echo hidden_pw($pw_c) ?></h3>
        </div>

        <div>
          <label class="control-label">登録画像</label><br>
            <img class="py-3" src="user_profile_img/<?php echo h($file_name) ?>" alt="Blog" style="width:140px;height:140px;border-radius: 50%; margin-bottom:15px; ">
        </div>


        <form method="POST" action="" class="form-horizontal">
        <fieldset>
        <!-- Button  モーダル発火-->
        <div class="form-group">
          <label class="col-md-4 control-label" for=""></label>
          <div class="col-md-4" id='register'>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#demoNormalModal">登録</button>
            <span hidden id="name"><?php echo h($name) ?></span>
            <span hidden id="email"><?php echo h($email) ?></span>
            <span hidden id="password"><?php echo password_hash($pw, PASSWORD_DEFAULT); ?></span>
            <span hidden id="img_name"><?php echo h($file_name) ?></span>
          </div>
        </div>

        </fieldset>
        </form>

        <!-- モーダルダイアログ -->
        <div class="modal fade" id="demoNormalModal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="demoModalTitle">ご登録ありがとうございました！</h3>
                    </div>
                    <div class="my_modal-footer">
                        <a href="signin.php"><button type="button" class="btn btn-success">サインインする</button></a>
                    </div>
                </div>
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

