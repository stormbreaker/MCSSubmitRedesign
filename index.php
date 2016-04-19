<!DOCTYPE html>
<html>
	<body>
		<?php
			require 'user.php';

			if (true)//User::isAuthenticated())
			{
				header("Location: submit.html");
			}
			else
			{
				header("Location: login.html");
			}
		?>
	</body>
</html>
