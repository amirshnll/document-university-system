<?php
	@session_start();
	if( isset($_SESSION['login']) && isset($_SESSION['user_type']) && isset($_SESSION['user_id']) )
		header("location:panel.php");

	require_once('system/functions.php');
	insert_view();
?>

<!DOCTYPE html>
<html>
<head>
	<title>صفحه اصلی | انتخاب بخش</title>
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
			<div class="index-page col-8">
				<div class="col-12 text-center text-light">
					<div class="alert alert-dark">
						<h1>خوش آمدید</h1>
					</div>
				</div>
				<br />
				<div class="float-right col-6">
					<a class="text-light" href="professor-login.php" title="ورود اساتید">
						<div class="mycard bg-info">
							<div class="mycard-image">
								<img src="assets/img/professor.png" title="ورود اساتید" alt="ورود اساتید" width="64" height="64" />
							</div>
							<div class="mycard-text">
								<p>ورود اساتید</p>
							</div>
						</div>
					</a>
				</div>
				<div class="float-left col-6">
					<a class="text-light" href="admin-login.php" title="ورود مدیر">
						<div class="mycard bg-info">
							<div class="mycard-image">
								<img src="assets/img/boss.png" title="ورود مدیر" alt="ورود مدیر" width="64" height="64" />
							</div>
							<div class="mycard-text">
								<p>ورود مدیر</p>
							</div>
						</div>
					</a>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="assets/bootstrap/js/"></script>
	<script type="text/javascript" src="assets/bootstrap/js/"></script>
</body>
</html>