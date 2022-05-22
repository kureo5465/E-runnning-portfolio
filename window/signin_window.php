<!DOCTYPE html>
<html lang="ja">
<head>
	<?php require("head.php"); ?>
</head>
<body>
	<div class="wrapper">
	<!-- header -->
	<?php require("header.php"); ?>
	  <main class="main">
	<!-- メッセージ表示 -->
	<?php require("message_window.php"); ?>
	  <div class="main_inner">
	   <h3 class="main_course_title">Sign in(Login)</h3>
	
		<!-- 値を送信 -->
	   <form action="signin_post.php" method="post">
		   <!-- トークン送信 -->
	   	   <input type="hidden" name="csrf_token" value="<?= h($csrf_token) ?>" />
		   <div class="form">
		   		<label for="name" class="form_name">User Name</label>
				<input type="text" placeholder="Your name" id="name" name="name">
		   </div>

		   <div class="form">
		   		<label for="name" class="form_name">Password</label>
				<input type="text" placeholder="password" id="password" name="password">
		   </div>

		   <button type="submit" class="form_button">Sign in  (ログインする)</button>
	   </form>
	   		<button class="exit_button"><a href="signup.php">Sign up  (アカウント作成画面)</a></button>
	  </div>
	</main>

	 <!-- footer -->
	 <?php require("footer.php"); ?>

	 </div>
</body>
</html>