<?php

	@session_start();

	if(isset($_SESSION['user_type']))
		unset($_SESSION['user_type']);

	if(isset($_SESSION['login']))
		unset($_SESSION['login']);

	if(isset($_SESSION['user_id']))
		unset($_SESSION['user_id']);

	@session_destroy();

	header("location:index.php");

?>