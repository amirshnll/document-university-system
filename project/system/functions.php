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

	function add_user($username, $password, $roll)
	{
		$connect = connect();
		$query = "INSERT INTO `tbl_user`(`username`, `password`, `register_time`, `type`, `status`) VALUES ('" . $username . "','" . $password . "','" . time() . "','" . $roll . "','1')";
		mysqli_query($connect, $query);

		$query = "SELECT `id` FROM `tbl_user` WHERE `username` = '" . $username . "'";
		$result = mysqli_query($connect, $query);

		if($result->num_rows==0)
			return -1;
		else
		{
			$result = mysqli_fetch_array($result);
			$user_id = $result['id'];
		}

		$query = "INSERT INTO `tbl_person`(`user_id`, `first_name`, `last_name`, `national_code`, `mobile`, `phone`, `address`, `personely_code`) VALUES ('" . $user_id . "','','','','','','','')";
		mysqli_query($connect, $query);

		return 1;
	}

	function all_users()
	{
		$connect = connect();
		$query = "SELECT * FROM `tbl_user` WHERE `status`='1'";
		$result = mysqli_query($connect, $query);
		return $result;
	}

	function delete_user($id)
	{
		$connect = connect();
		$query = "UPDATE `tbl_user` SET `status`='0' WHERE `id` = '" . $id . "'";
		$result = mysqli_query($connect, $query);
		return $result;
	}

	function load_person($user_id)
	{
		$connect = connect();
		$query = "SELECT * FROM `tbl_person` WHERE `user_id` = '" . $user_id . "'";
		$result = mysqli_query($connect, $query);
		$result = mysqli_fetch_array($result);
		return $result;
	}

	function update_person($user_id,$first_name, $last_name, $national_code, $mobile, $phone, $personely_code, $address)
	{
			$connect = connect();
			$query = "UPDATE `tbl_person` SET `first_name`='" . $first_name . "',`last_name`='" . $last_name . "',`national_code`='" . $national_code . "',`mobile`='" . $mobile . "',`phone`='" . $phone . "',`personely_code`='" . $personely_code . "',`address`='" . $address . "' WHERE `user_id` = '" . $user_id . "'";
			if(mysqli_query($connect, $query))
				return 1;
			else
				return -1;
	}

	function insert_document($user_id, $file_name, $type)
	{
		$connect = connect();
		$query = "INSERT INTO `tbl_document`(`user_id`, `file_name`, `status`, `upload_time`, `type`, `user_agent`, `admin_review`) VALUES ('" . $user_id . "', '" . $file_name . "', '1', '" . time() . "', '" . $type . "', '" . $_SERVER['HTTP_USER_AGENT'] . " / ip : " . $_SERVER['REMOTE_ADDR'] . "', '')";
		mysqli_query($connect, $query);
	}

	function load_user_documents($user_id)
	{
		$connect = connect();
		$query = "SELECT * FROM `tbl_document` WHERE `user_id` = '" . $user_id . "'";
		$result = mysqli_query($connect, $query);
		return $result;
	}

	function load_documents()
	{
		$connect = connect();
		$query = "SELECT `tbl_document`.`id`, `tbl_document`.`file_name`, `tbl_document`.`status`, `tbl_document`.`admin_review`, `tbl_user`.`username` FROM `tbl_document` LEFT JOIN `tbl_user` ON `tbl_document`.`user_id` = `tbl_user`.`id` WHERE `tbl_user`.`status` = 1";
		$result = mysqli_query($connect, $query);
		return $result;
	}

	function single_review($id)
	{
		$connect = connect();
		$query = "SELECT * FROM `tbl_document` WHERE `id` = '" . $id . "'";
		$result = mysqli_query($connect, $query);
		$result = mysqli_fetch_array($result);
		return $result['admin_review'];
	}

	function single_document($id)
	{
		$connect = connect();
		$query = "SELECT * FROM `tbl_document` WHERE `id` = '" . $id . "'";
		$result = mysqli_query($connect, $query);
		$result = mysqli_fetch_array($result);
		return $result['file_name'];
	}

	function set_review($id, $review)
	{
		$connect = connect();
		$query = "UPDATE `tbl_document` SET `admin_review`='" . $review . "', `status`='2' WHERE `id` = '" . $id . "'";
		$result = mysqli_query($connect, $query);
		return 1;
	}

?>