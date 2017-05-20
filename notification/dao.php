<?php
	require_once 'db-config.php';

	function connectDB() {
		Global $dbhost, $dbname, $username, $password;
		$con = mysqli_connect($dbhost,$username,$password,$dbname) ;
		return $con;
	}
?>