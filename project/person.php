<?php
	@session_start();
	if( !isset($_SESSION['login']) || !isset($_SESSION['user_type']) || !isset($_SESSION['user_id']) )
		header("location:index.php");
?>