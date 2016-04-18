<!DOCTYPE html>
<html>
	<body>
		<?php
			require 'user.php';

			if (User::isAuthenticated())
			{
				header("Location: submit.php");
			}
			else
			{
				header("Location: login.html");
			}
		?>
	</body>
</html>
