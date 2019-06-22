<?php
	@session_start();
	if( !isset($_SESSION['login']) || !isset($_SESSION['user_type']) || !isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 2 )
		header("location:index.php");
?>