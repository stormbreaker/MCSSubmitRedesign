<?php
	ob_start();
	require 'user.php';
	if (User::isAuthenticated())
	{
		header("Location: submit.php");
	}
	else
	{
		header("Location: login.php");
	}
?>
