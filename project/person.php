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
	<title>پنل - مشخصات</title>
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
	if( isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['national_code']) && isset($_POST['mobile']) && isset($_POST['phone']) && isset($_POST['personely_code']) && isset($_POST['address']) )
	{
		if( !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['national_code']) && !empty($_POST['mobile']) && !empty($_POST['phone']) && !empty($_POST['personely_code']) && !empty($_POST['address']) )
		{
			$first_name			= ltrim(rtrim($_POST['first_name']));
			$last_name			= ltrim(rtrim($_POST['last_name']));
			$national_code		= ltrim(rtrim($_POST['national_code']));
			$mobile				= ltrim(rtrim($_POST['mobile']));
			$phone				= ltrim(rtrim($_POST['phone']));
			$personely_code		= ltrim(rtrim($_POST['personely_code']));
			$address			= ltrim(rtrim($_POST['address']));

			if(update_person($_SESSION['user_id'], $first_name, $last_name, $national_code, $mobile, $phone, $personely_code, $address) === 1)
				$success = "عملیات موفق";
			else
				$error = "عملیات ناموفق";
		}
		else
		{
			$error = "عملیات ناموفق";
		}
	}


	$person = load_person($_SESSION['user_id']);
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
						<h2>مشخصات</h2>
						<form action="" method="post">
							<table width="100%" class="form-group">
								<tr>
									<td width="20%"><label for="first_name">نام</label></td>
									<td width="80%"><input type="text" name="first_name" id="first_name" class="form-control" value="<?php echo $person['first_name'] ?>" /></td>
								</tr>
								<tr>
									<td width="20%"><label for="last_name">نام خانوادگی</label></td>
									<td width="80%"><input type="text" name="last_name" id="last_name" class="form-control" value="<?php echo $person['last_name'] ?>" /></td>
								</tr>
								<tr>
									<td width="20%"><label for="national_code">کدملی</label></td>
									<td width="80%"><input type="text" name="national_code" id="national_code" class="form-control" value="<?php echo $person['national_code'] ?>" /></td>
								</tr>
								<tr>
									<td width="20%"><label for="mobile">تلفن همراه</label></td>
									<td width="80%"><input type="text" name="mobile" id="mobile" class="form-control" value="<?php echo $person['mobile'] ?>" /></td>
								</tr>
								<tr>
									<td width="20%"><label for="phone">تلفن ثابت</label></td>
									<td width="80%"><input type="text" name="phone" id="phone" class="form-control" value="<?php echo $person['phone'] ?>" /></td>
								</tr>
								<tr>
									<td width="20%"><label for="personely_code">کد پرسنلی</label></td>
									<td width="80%"><input type="text" name="personely_code" id="personely_code" class="form-control" value="<?php echo $person['personely_code'] ?>" /></td>
								</tr>
								<tr>
									<td width="20%"><label for="address">آدرس</label></td>
									<td width="80%"><input type="text" name="address" id="address" class="form-control" value="<?php echo $person['address'] ?>" /></td>
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