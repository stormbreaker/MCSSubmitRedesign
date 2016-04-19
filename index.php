<?php
	ob_start();
	require 'user.php';
	if (true)//User::isAuthenticated())
	{
		header("Location: submittest.html");
	}
	else
	{
		header("Location: login.html");
	}
?>
