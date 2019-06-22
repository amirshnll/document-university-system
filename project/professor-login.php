<?php
	@session_start();
	if( isset($_SESSION['login']) && isset($_SESSION['user_type']) && isset($_SESSION['user_id']) )
		header("location:panel.php");

	require_once('system/functions.php');
	insert_view();

	$error = -1;
	if( isset($_POST['username']) && isset($_POST['password']) ) {
		if( !empty($_POST['username']) && !empty($_POST['password']) )
		{
			$username = rtrim(ltrim($_POST['username']));
			$password = rtrim(ltrim(md5($_POST['password'])));

			$login = login($username, $password, 1);
			if($login !== -1)
			{
				$_SESSION['login'] = 1;
				$_SESSION['user_type'] = 1;
				$_SESSION['user_id'] = $login;
				header("location:panel.php");

			}
			else 
			{
				$error = "خطا در ورود";
			}
		}
		else
		{
			$error = "خطا در ورود";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>ورود به پنل  | اساتید</title>
	<link rel="stylesheet" type="text/css" href="assets/css/layout.css">
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap-grid.min.css">
	<link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon.png">
</head>

<?php
	require_once('system/functions.php');
	$background = random_background();
?>

<body style="background: url(assets/img/<?php echo $background; ?>) no-repeat center; background-size: cover;background-attachment: fixed;">

	<div class="container">
		<div class="row">
			<div class="login-page">
				<div class="col-12 text-center text-light">
					<div class="alert alert-dark">
						<h1>ورود به پنل اساتید</h1>
					</div>
				</div>
				<div class="form-group bg-info text-right">
					<form action="" method="post">
						<p>
							<label for="username">نام کاربری : </label>
							<input type="text" name="username" id="username" class="form-control" />
						</p>
						<p>
							<label for="password">رمزعبور : </label>
							<input type="password" name="password" id="password" class="form-control" />
						</p>
						<p>&nbsp;</p>
						<p>
							<input type="submit" name="submit" value="ورود به پنل" class="btn btn-success float-left" />
							<span class="float-left">&nbsp;</span>
							<a href="index.php" class="btn btn-danger float-left" title="بازگشت">بازگشت</a>
						</p>
					</form>
					<div class="clearfix"></div>
				</div>
				<?php
					if($error !== -1)
						echo '<p class="alert alert-danger text-right">' . $error . '</p>';
				?>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="assets/bootstrap/js/"></script>
	<script type="text/javascript" src="assets/bootstrap/js/"></script>
</body>
</html>