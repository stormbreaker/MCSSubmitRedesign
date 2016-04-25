<html>
	<head>
		<title>Submit It!</title>
		<!-- stylesheet -->
		<link rel="stylesheet" type="text/css" href="submitstyle.css"/>
		<script type="text/javascript" src="submit.js"></script>
	</head>
	<body>
		<!--The standard page header-->
		<header>
			<div class="centerLR">
				<img src="SDSMT_LOGO.png" width="75"/>
				<br/>
				<div class="minesGold">
					<div class="dropdown"> <a>Alumni</a> </div>
					<div class="dropdown"> <a>Directory</a> </div>
					<div class="dropdown"> <a>Faculty</a> </div>
					<div class="dropdown"> <a>Login</a> </div>
					<div class="dropdown"> <a>Map</a> </div>
					<div class="dropdown"> <a>Policy</a> </div>
					<div class="dropdown"> <a>Program</a> </div>

					<div class="dropdown">
						<a>Research</a>
						<div class="dropdown-content" id="myDropdown">
							<a href="sinkhole.html">Checklist</a><br/>
							<a href="sinkhole.html">Courses</a><br/>
							<a href="sinkhole.html">Scheduler</a>
						</div>
					</div>
				</div>
			</div>
		</header>
		<?php
		require 'user.php';

		//If a login is requested
		if (isset($_POST['username']) && isset($_POST['password']))
		{
			$username = $_POST['username'];
			$password = $_POST['password'];

			//If the login fails, display an error
			if (!User::authenticate($username, $password))
			{
				echo "<p>That username/password combination did not match anything in our records. Please try again.</p>";
			}
			//If the login is successful, redirect to the submission page
			else
			{
				header("Location: submit.php");
			}
		}
		//If a logout is requested
		elseif (isset($_POST['logout']))
		{
			if (User::isAuthenticated())
			{
				User::getCurrentUser()->logOut();
			}
		}
		?>
		<form action="login.php" method="post">
			<br/>
			<!--If a login fails, this html will be displayed for another login attemp-->
			<div name="usernameContainer">
				<label style="display:inline-block; width:80px">Username: </label>
				<input type="text" name="username">
			</div>
			<br/>
			<div name="passwordContainer">
				<label style="display:inline-block; width:80px">Password: </label>
				<input type="password" name="password">
			</div>
			<br/>
			<input type="submit" value="Login">
		</form>
	</body>
</html>
