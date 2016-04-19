<!DOCTYPE html>
<html>
	<body>
		<?php
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
	</body>
</html>
