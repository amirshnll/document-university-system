<?php
	@session_start();
	if( !isset($_SESSION['login']) || !isset($_SESSION['user_type']) || !isset($_SESSION['user_id']) )
		header("location:index.php");

	require_once('system/functions.php');
	insert_view();
?>

<!DOCTYPE html>
<html>
<head>
	<title>پنل - تغییر رمزعبور</title>
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

	$error = -1;
	$success = -1;
	if( isset($_POST['old_password']) && isset($_POST['new_password']) && isset($_POST['renew_password']) )
	{
		if( !empty($_POST['old_password']) && !empty($_POST['new_password']) && !empty($_POST['renew_password']) )
		{
			$old_password = ltrim(rtrim(md5($_POST['old_password'])));
			$new_password = ltrim(rtrim(md5($_POST['new_password'])));
			$renew_password = ltrim(rtrim(md5($_POST['renew_password'])));

			if($new_password !== $renew_password)
				$error = "عملیات ناموفق";
			elseif(change_password($_SESSION['user_id'], $old_password, $new_password) === 1)
				$success = "عملیات موفق";
			else
				$error = "عملیات ناموفق";
		}
		else
		{
			$error = "عملیات ناموفق";
		}
	}
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
						<h2>تغییر رمزعبور</h2>
						<form action="" method="post">
							<table width="100%" class="form-group">
								<tr>
									<td width="20%"><label for="old_password">رمزعبور فعلی</label></td>
									<td width="80%"><input type="password" name="old_password" id="old_password" class="form-control" /></td>
								</tr>
								<tr>
									<td width="20%"><label for="new_password">رمزعبور جدید</label></td>
									<td width="80%"><input type="password" name="new_password" id="new_password" class="form-control" /></td>
								</tr>
								<tr>
									<td width="20%"><label for="renew_password">تکرار رمزعبور</label></td>
									<td width="80%"><input type="password" name="renew_password" id="renew_password" class="form-control" /></td>
								</tr>
								<tr>
									<td colspan="2"><input type="submit" name="submit" value="ثبت" class="btn btn-success float-left" /></td>
								</tr>
							</table>
							<div class="clearfix"></div>
						</form>
						<?php
							if($error !== -1)
								echo '<p class="alert alert-danger text-right">' . $error . '</p>';
							if($success !== -1)
								echo '<p class="alert alert-success text-right">' . $success . '</p>';
						?>
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