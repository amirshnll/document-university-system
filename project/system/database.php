<?php
	function connect(){
		$server='localhost';
		$username='root';
		$password='';
		$dbName='university_system';		
		if(!@$connection = mysqli_connect($server,$username,$password,$dbName))
			die(' :( ');
		mysqli_query($connection,'SET CHARACTER SET utf8;');
		return $connection;
	}
?>