<?php
    session_start();
    require('dbconnect.php');
    require('functions.php');

    $validations = [];

    $name = "";
    $email = "";
    $pw = "";

    if(!empty($_POST)){

        $name = $_POST['name'];
        $email = $_POST['email'];
        $pw = $_POST['password'];

        $sql='SELECT * FROM `users` WHERE `email`=?';
        $stmt = $dbh->prepare($sql);
        $data = [$email];
        $stmt->execute($data);
        $record = $stmt->fetch(PDO::FETCH_ASSOC);

        // 名前の空チェック
        if($name == ''){
        		$validations['name'] = 'blank';
        }
        // 名前の空チェック & 登録済みのメールアドレスチェック
        if($email == ''){
        		$validations['email'] = 'blank';
        }elseif($email== $record['email']){
            $validations['email'] = 'is_email';
        }

        // パスワードのからチェック 4文字以上16文字以下の英数字
        $pw_c = strlen($pw);
        $pw_int = preg_match('/[0-9]/', $pw);
        $pw_alpha = preg_match('/[a-zA-Z]/', $pw);
        $pw_int_alpha = preg_match('/[^0-9a-zA-Z]/', $pw);

        if($pw == ''){
        		$validations['password'] = 'blank';
        }elseif($pw_c < 4 || 16 < $pw_c || $pw_int == FALSE || $pw_alpha == FALSE || $pw_int_alpha == TRUE){
        		$validations['password'] = 'unmatch';
        }

        $file_name = $_FILES['img_name']['name'];
        if($file_name==''){
            $validations['img_name'] = 'blank';
        }

        if(empty($validations)){
        		$tmp_file = $_FILES['img_name']['tmp_name'];
        		$file_name = date('YmdHis') .$_FILES['img_name']['name'];
        		$destination = 'user_profile_img/'.$file_name;
        		move_uploaded_file($tmp_file, $destination);

        		$_SESSION['BOOKLIKES']['name'] = $name;
        		$_SESSION['BOOKLIKES']['email'] = $email;
        		$_SESSION['BOOKLIKES']['password'] = $pw;
        		$_SESSION['BOOKLIKES']['file_name'] = $file_name;

        		header('Location: check.php');
        		exit();
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
	<title>新規会員登録</title>
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
				<form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
				<fieldset>

				<!-- Form Name -->
				<legend>新規会員登録</legend>

				<!-- Text input-->
				<div class="form-group">
				  <label class="col-md-4 control-label">お名前</label>
				  <div class="col-md-4">
				    <input id="name" name="name" type="text" placeholder="お名前" value="<?php echo $name ?>" class="form-control input-md">
				    <span class="error_msg"><?php echo result($validations, 'name', 'お名前') ?></span>
				  </div>
				</div>

				<!-- Text input-->
				<div class="form-group">
				  <label class="col-md-4 control-label">メールアドレス</label>
				  <div class="col-md-4">
				    <input id="email" name="email" type="text" placeholder="メールアドレス" value="<?php echo $email ?>" class="form-control input-md">
				    <span class="error_msg"><?php echo result($validations, 'email', 'メールアドレス') ?></span>
            <?php if (isset($validations['email']) && $validations['email'] == 'is_email') :?>
            <span class="error_msg">このメールアドレスはすでに登録されています。</span>
          <?php endif ?>
				  </div>
				</div>

				<!-- Password input-->
				<div class="form-group">
				  <label class="col-md-4 control-label">パスワード(4~16文字の英数字)</label>
				  <div class="col-md-4">
				    <input id="password" name="password" type="password" placeholder="パスワード" class="form-control input-md">
				    <span class="error_msg"><?php echo result_pw($validations, 'password') ?></span>
				  </div>
				</div>

				<div class="form-group">
					  <img id="img1" src="https://placehold.jp/160x160.png" style="width:160px;height:160px;border-radius: 50%;"><br>
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

				<!-- Button -->
				<div class="form-group">
				  <label class="col-md-4 control-label"></label>
				  <div class="col-md-4">
				    <input type="submit" class="btn btn-success" value="確認">
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

