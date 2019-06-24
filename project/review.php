<?php
	@session_start();
	if( !isset($_SESSION['login']) || !isset($_SESSION['user_type']) || !isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 2 )
		header("location:index.php");

	require_once('system/functions.php');
	
	if(isset($_GET['id']) && is_numeric($_GET['id']))
		$_GET['id'] = ltrim(rtrim($_GET['id']));
	else
		header("location:users-document.php");

	$error = -1;
	$success = -1;
	if( isset($_POST['admin_review']) )
	{
		if( !empty($_POST['admin_review']) )
		{
			$admin_review = ltrim(rtrim($_POST['admin_review']));

			if(set_review($_GET['id'], $admin_review) === 1)
				$success = "عملیات موفق";
			else
				$error = "عملیات ناموفق";
		}
		else
		{
			$error = "عملیات ناموفق";
		}
	}

	$review = single_review($_GET['id']);
	$file_name = single_document($_GET['id']);
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>پنل - ثبت نظر </title>
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
						<h2>ثبت نظر</h2>
						<p>ثبت نظر برای فایل ( <a target="_blank" href="<?php echo $file_name; ?>" title="مشاهده فایل"><?php echo $file_name; ?></a> )</p>
						<form action="" method="post" class="form-group">
							<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
							<textarea name="admin_review" maxlength="255" class="form-control" rows="5"><?php echo $review; ?></textarea>
							<br />
							<input type="submit" name="submit" value="ثبت" class="btn btn-success float-left" />
							<span class="float-left">&nbsp;</span>
							<a href="users-document.php" class="btn btn-danger float-left" title="بازگشت">بازگشت</a>
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