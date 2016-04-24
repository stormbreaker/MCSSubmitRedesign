<?php
	require 'user.php';

	if (isset($_POST['username']) && isset($_POST['password']))
	{
    	$username = $_POST['username'];
    	$password = $_POST['password'];

    	if (!User::authenticate($username, $password))
    	{
    		echo "<p>Login Failed, please try again.</p><br/>";
    	}

    	header('Location: index.php');
	}
	elseif (isset($_POST['logout']))
	{
		if (User::isAuthenticated())
		{
			User::getCurrentUser()->logOut();
		}
	}
?>

<form action="login.php" method="post">
	<p>That username/password combination did not match anything in our records. Please try again.</p>
	<label>Username: </label>
	<input type="text" name="username">
	<label>Password: </label>
	<input type="password" name="password">
	<input type="submit" value="Login">
</form>
