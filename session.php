<?php
	require_once("connection.php");
	session_start();// Starting Session
	$sessionuser=$_SESSION['sessionuser'];
	
	if(!dbQuery("select email from users where email='$sessionuser'")){
		header('Location: login.php'); // if they are not logged in, redirrect them to login page
	}
?>