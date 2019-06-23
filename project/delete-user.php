<?php
	@session_start();
	if( !isset($_SESSION['login']) || !isset($_SESSION['user_type']) || !isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 2 )
		header("location:index.php");

	require_once('system/functions.php');
	
	if(isset($_GET['id']) && is_numeric($_GET['id']))
	{
		$_GET['id'] = ltrim(rtrim($_GET['id']));
		delete_user($_GET['id']);
	}

	header("location:users.php")

?>