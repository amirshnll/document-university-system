<?php

	require_once('database.php');

	function random_background()
	{
		return rand(1,4) . ".png";
	}

	function insert_view()
	{
		$connect = connect();
		$query = "INSERT INTO `tbl_view`(`time`, `user_agent`) VALUES ('" . time() . "','" . $_SERVER['HTTP_USER_AGENT'] . " / ip : " . $_SERVER['REMOTE_ADDR'] . "')";
		mysqli_query($connect, $query);
	}

	function login($username, $password, $type)
	{
		$connect = connect();
		$query = "SELECT `id` FROM `tbl_user` WHERE `username` = '" . $username . "' AND `password` = '" . $password . "' AND `type` = '" . $type . "' AND `status` = 1";
		$result = mysqli_query($connect, $query);

		if($result->num_rows==0)
			return -1;
		else
		{
			$result = mysqli_fetch_array($result);
			insert_login($result['id']);
			return $result['id'];
		}
	}

	function insert_login($user_id)
	{
		$connect = connect();
		$query = "INSERT INTO `tbl_login`(`user_id`, `login_time`, `user_agent`) VALUES ('" . $user_id . "','" . time() . "','" . $_SERVER['HTTP_USER_AGENT'] . " / ip : " . $_SERVER['REMOTE_ADDR'] . "')";
		mysqli_query($connect, $query);
	}


	function today_view()
	{
		$connect = connect();
		$query = "SELECT `id` FROM `tbl_view` WHERE `time` > '" . strtotime( date('d') . "-" . date('m') . "-" . date('Y') )  . "'";
		$result = mysqli_query($connect, $query);
		return $result->num_rows;
	}

	function yesterday_view()
	{
		$connect = connect();
		$query = "SELECT `id` FROM `tbl_view` WHERE `time` > '" . strtotime( date('d') - 1 . "-" . date('m') . "-" . date('Y') )  . "' AND `time` < '" . strtotime( date('d') . "-" . date('m') . "-" . date('Y') )  . "'";
		$result = mysqli_query($connect, $query);
		return $result->num_rows;
	}

	function month_view()
	{
		$connect = connect();
		$query = "SELECT `id` FROM `tbl_view` WHERE `time` > '" . strtotime( "01-" . date('m') . "-" . date('Y') )  . "' AND `time` < '" . strtotime( date('d') . "-" . date('m') . "-31" )  . "'";
		$result = mysqli_query($connect, $query);
		return $result->num_rows;
	}

	function year_view()
	{
		$connect = connect();
		$query = "SELECT `id` FROM `tbl_view` WHERE `time` > '" . strtotime( "01-01-" . date('Y') )  . "' AND `time` < '" . strtotime( "30-12-" . date('Y') )  . "'";
		$result = mysqli_query($connect, $query);
		return $result->num_rows;
	}

	function total_view()
	{
		$connect = connect();
		$query = "SELECT `id` FROM `tbl_view` WHERE 1";
		$result = mysqli_query($connect, $query);
		return $result->num_rows;
	}

	function users_count()
	{
		$connect = connect();
		$query = "SELECT `id` FROM `tbl_user` WHERE 1";
		$result = mysqli_query($connect, $query);
		return $result->num_rows;
	}

	function logins_count()
	{
		$connect = connect();
		$query = "SELECT `id` FROM `tbl_login` WHERE 1";
		$result = mysqli_query($connect, $query);
		return $result->num_rows;
	}	

	function documents_count()
	{
		$connect = connect();
		$query = "SELECT `id` FROM `tbl_document` WHERE 1";
		$result = mysqli_query($connect, $query);
		return $result->num_rows;
	}

	function change_password($user_id, $old_password, $new_password)
	{
		$connect = connect();
		$query = "SELECT `password` FROM `tbl_user` WHERE `id` = '" . $user_id . "' AND `status` = 1";
		$result = mysqli_query($connect, $query);

		if($result->num_rows==0)
			return -1;
		else
		{
			$result = mysqli_fetch_array($result);
			if($result['password'] === $old_password)
			{
				$query = "UPDATE `tbl_user` SET `password`='" . $new_password . "' WHERE `id` = '" . $user_id . "' AND `status` = 1";
				if(mysqli_query($connect, $query))
					return 1;
				else
					return -1;
			}
			else
				return -1;
		}
	}

?>