<?php
		session_start();
		require('dbconnect.php');
		require('functions.php');

		$validations = [];

		if(!empty($_POST)){
				$email = $_POST['email'];
				$pw = $_POST['password'];

				if($email != '' && $pw != ''){

						$sql='SELECT * FROM `users` WHERE `email`=?';
						$stmt = $dbh->prepare($sql);
						$data = [$email];
						$stmt->execute($data);
						$record = $stmt->fetch(PDO::FETCH_ASSOC);

						if($record == FALSE){
								$validations['signin'] = 'failed';
						}elseif(password_verify($pw,$record['password'])){
								$_SESSION['BOOKLIKES']['id'] = $record['id'];
								header('Location: mypage.php');
								exit();
						}else{
							 $validations['signin'] = 'failed';
						}

				}else{
						$validations['signin'] = 'blank';
				}
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
	<title>サインイン</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Website Template by FreeHTML5.co" />
	<meta name="keywords" content="free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
	<meta name="author" content="FreeHTML5.co" />

  	<!--
	//////////////////////////////////////////////////////

	FREE HTML5 TEMPLATE
	DESIGNED & DEVELOPED by FreeHTML5.co

	Website: 		http://freehtml5.co/
	Email: 			info@freehtml5.co
	Twitter: 		http://twitter.com/fh5co
	Facebook: 		https://www.facebook.com/fh5co

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
<!-- 				<ul>
					<li><a href="#"><i class="icon-facebook2"></i></a></li>
					<li><a href="#"><i class="icon-twitter2"></i></a></li>
					<li><a href="#"><i class="icon-instagram"></i></a></li>
					<li><a href="#"><i class="icon-linkedin2"></i></a></li>
				</ul> -->
			</div>

		</aside>

		<div id="fh5co-main">
			<div class="fh5co-narrow-content text-center">
				<form method="POST" action="" class="form-horizontal">
				<fieldset>

				<!-- Form Name -->
				<legend>サインイン</legend>
				<?php if (isset($validations['signin']) && $validations['signin'] == 'blank'): ?>
					<h4 class="error_msg">メールアドレスとパスワードを正しく入力してください。</h4>
				<?php elseif(isset($validations['signin']) && $validations['signin'] == 'failed'): ?>
					<h4 class="error_msg">ログインに失敗しました。</h4>
				<?php endif ?>


				<!-- Text input-->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="email">メールアドレス</label>
				  <div class="col-md-4">
				  <input id="email" name="email" type="text" placeholder="メールアドレス" class="form-control input-md">
				  </div>
				</div>

				<!-- Password input-->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="password">パスワード(4~16文字の英数字)</label>
				  <div class="col-md-4">
				    <input id="password" name="password" type="password" placeholder="パスワード" class="form-control input-md">
				  </div>
				</div>

				<!-- Button -->
				<div class="form-group">
				  <label class="col-md-4 control-label" for=""></label>
				  <div class="col-md-4">
				  	<input type="submit" class="btn btn-success" value="ログイン">
				  </div>
				</div>

				</fieldset>
				</form>
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

