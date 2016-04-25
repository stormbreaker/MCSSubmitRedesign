<?php
	require 'user.php';

	if (isset($_POST['UserName']) && isset($_POST['Password']))
	{
    	$username = $_POST['UserName'];
    	$password = $_POST['Password'];

		if (false)//!User::authenticate($username, $password))
		{
			echo "<p>That username/password combination did not match anything in our records. Please try again.</p>";
		}
		else
		{
			header("Location: submit.php");
		}
	}
    elseif (isset($_POST['isAuthenticated']))
    {
        $user = User::getCurrentUser();

        if (!is_null($user))
        {
            echo User::isAuthenticated()." ".$user->getUsername();
        }

        // echo User::isAuthenticated()." ".$user->getUsername();
        // echo User::isAuthenticated()." ".User::getUsername();
    }
	elseif (isset($_POST['logout']))
	{
		if (User::isAuthenticated())
		{
			User::getCurrentUser()->logOut();
		}
	}
?>
