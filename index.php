<?php
	ob_start();
	require 'user.php';
	if (true)//User::isAuthenticated())
	{
		header("Location: submit.php");
	}
	else
	{
		header("Location: login.html");
	}
?>
