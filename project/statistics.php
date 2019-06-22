<?php
	@session_start();
	if( !isset($_SESSION['login']) || !isset($_SESSION['user_type']) || !isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 2 )
		header("location:index.php");

	require_once('system/functions.php');
	insert_view();

	$today		= today_view();
	$yesterday	= yesterday_view();
	$month		= month_view();
	$year 		= year_view();
	$total 		= total_view();
	$users		= users_count();
	$logins		= logins_count();
	$documents	= documents_count();
?>

<!DOCTYPE html>
<html>
<head>
	<title>پنل - آمار سایت</title>
	<link rel="stylesheet" type="text/css" href="assets/css/layout.css">
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap-grid.min.css">
	<link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon.png">
</head>

<?php
	require_once('system/functions.php');
	$background = random_background();

	if(isset($_SESSION['user_type'])) {
		if($_SESSION['user_type'] == 1)
			$type = "اساتید";
		else
			$type = "مدیر";
	}
	else
		$type = "اساتید";
?>

<body style="background: url(assets/img/<?php echo $background; ?>) no-repeat center; background-size: cover; background-attachment: fixed;">

	<div class="container">
		<div class="row">
			<div class="mypanel-page col-12">
				<div class="col-12 text-center text-light">
					<div class="alert alert-dark">
						<h1>پنل <?php echo $type; ?></h1>
					</div>
				</div>
				<br />
				<div class="col-12">
					<div class="float-right col-3 mypanel-menu bg-light">
						<nav class="navbar col-12">
							<ul class="nav col-12">
								<li class="nav-item col-12"><a href="panel.php" class="col-12 btn btn-primary" title="پیشخوان">پیشخوان</a></li>

								<?php
									if($type === "اساتید") {
										?>
										<li class="nav-item col-12"><a href="upload.php" class="col-12 btn btn-primary" title="آپلود مدارک">آپلود مدارک</a></li>
										<li class="nav-item col-12"><a href="document.php" class="col-12 btn btn-primary" title="بررسی مدارک">بررسی مدارک</a></li>
										<?php
									} elseif ($type === "مدیر") {
										?>
										<li class="nav-item col-12"><a href="users.php" class="col-12 btn btn-primary" title="مدیریت کاربران">مدیریت کاربران</a></li>
										<li class="nav-item col-12"><a href="users-document.php" class="col-12 btn btn-primary" title="مدارک">مدارک</a></li>
										<li class="nav-item col-12"><a href="statistics.php" class="col-12 btn btn-primary" title="آمار سایت">آمار سایت</a></li>
										<?php
									}
								?>

								<li class="nav-item col-12"><a href="person.php" class="col-12 btn btn-primary" title="ویرایش مشخصات">ویرایش مشخصات</a></li>
								<li class="nav-item col-12"><a href="password.php" class="col-12 btn btn-primary" title="تغییر رمزعبور">تغییر رمزعبور</a></li>
								<li class="nav-item col-12"><a href="out.php" class="col-12 btn btn-danger" title="خروج">خروج</a></li>
							</ul>
						</nav>
					</div>
					<div class="float-left col-8 mypanel-content bg-light text-right">
						<h2>آمار سایت</h2>
						<table width="100%" class="table table-striped">
							<tr>
								<td width="30%">بازدید امروز</td>
								<td width="70%"><?php echo $today; ?></td>
							</tr>
							<tr>
								<td width="30%">بازدید دیروز</td>
								<td width="70%"><?php echo $yesterday; ?></td>
							</tr>
							<tr>
								<td width="30%">بازدید این ماه</td>
								<td width="70%"><?php echo $month; ?></td>
							</tr>
							<tr>
								<td width="30%">بازدید امسال</td>
								<td width="70%"><?php echo $year; ?></td>
							</tr>
							<tr>
								<td width="30%">بازدید کل</td>
								<td width="70%"><?php echo $total; ?></td>
							</tr>
							<tr>
								<td width="30%">تعداد کاربران</td>
								<td width="70%"><?php echo $users; ?></td>
							</tr>
							<tr>
								<td width="30%">تعداد ورود به پنل</td>
								<td width="70%"><?php echo $logins; ?></td>
							</tr>
							<tr>
								<td width="30%">تعداد اسناد</td>
								<td width="70%"><?php echo $documents; ?></td>
							</tr>
						</table>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="assets/bootstrap/js/"></script>
	<script type="text/javascript" src="assets/bootstrap/js/"></script>
</body>
</html>