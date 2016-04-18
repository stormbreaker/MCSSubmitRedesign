<?php
	require 'user.php';

	User::authenticate($_POST["username"], $_POST["password"]);
	header('Location: index.php');
?>
