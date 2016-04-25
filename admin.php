<?php
	require 'user.php';
	User::declarePermission('canEditCourseInfo');
	if (User::isAuthenticated())
	{
		$user = User::getCurrentUser();
		if ($user->hasPermission('canEditCourseInfo') == false)
		{
			header("Location: submit.php");
		}
	}
	else {
			header("Location: submit.php");
	}
?>

<html>
    <head>
        <title>
            Class Administration
        </title>
        <script type="text/javascript" src="admin.js"></script>
        <link rel="stylesheet" type="text/css" href="submitstyle.css"/>
    </head>
    <body>
		<header>
			<div class="minesGold">
				<!--Department Logo-->
				<img src="MCS_LOGO.png" class="imageProperties"/>
				<br/>
				<!--Navigation Menu-->
				<div>
					<div class="dropdown"> <a href="index.html">Home</a> </div>
					<div class="dropdown"> <a href="sinkhole.html">Alumni</a> </div>
					<div class="dropdown"> <a href="sinkhole.html">Directory</a> </div>
					<div class="dropdown"> <a href="sinkhole.html">Faculty</a> </div>
					<div class="dropdown"> <a href="sinkhole.html">Map</a> </div>
					<div class="dropdown"> <a href="sinkhole.html">Policy</a> </div>
					<div class="dropdown"> <a href="sinkhole.html">Program</a> </div>
					<div class="dropdown"> <a href="sinkhole.html">Research</a> </div>
					<!--Dropdown Navigation-->
					<div class="dropdown">
						<a>Student</a>
						<div class="dropdown-content" id="myDropdown">
							<a href="sinkhole.html">Checklist</a><br/>
							<a href="sinkhole.html">Courses</a><br/>
							<a href="sinkhole.html">Scheduler</a>
							<a href="submit.php">Submit It!</a>
						</div>
					</div>
					<!--Login Fields-->
					<span class="loginfields" id="LoginDiv">
						<label>Username: </label>
						<input type="text" id="UserName"/>
						<label>Password: </label>
						<input type="password" id="Password"/>

						<input type="button" value="Login" onclick="LoginUser();"/>
					</span>
				</div>
			</div>
		</header>
		<br/>
		<!--The html elements for professor and class administration-->
        <form action="admin.php" method="post">
            <label style="display:inline-block; width:160px" for="first">Professor's First Name: </label>
            <input type="text" name="first" id="first"/>
			<br/>
            <label style="margin-top: 5px; display:inline-block; width:160px" style="display:inline-block; width:80px" for="last">Professor's Last Name: </label>
            <input type="text" name="last" id="last"/>
            <br/>
            <br/>
            <input type="button" value="Add Course" onclick="AddClass()"/>
            <div id="classDiv"><!--class numbers go here--></div>
            <br/>
            <br/>
            <input type="submit" name="execute" value="Add Professor and Classes" onclick="AddCourseDataXML()"/>
            <input type="text"  name="courseCount" id="courseCount" value="0" style="display:none">
        </form>
        <?php
            if(isset($_POST['execute']))
            {
				//Create the folder for items submitted to this professor to be saved to
                $proffolder = "";
                $proffolder.= $_POST['first'][0];
                for ($i = 0; $i < 7; $i++)
                {
                    $proffolder.=$_POST['last'][$i];
                }
                echo $proffolder;
                chdir("submit");
                mkdir($proffolder, 0755);
                chdir($proffolder);
                for ($i = 1; $i < $_POST['courseCount'] + 1; $i++)
                {
					//Create a folder for each course taught by this professor
                    $courseName = $_POST['classNumber'.$i];
                    mkdir($courseName, 0755);
                }
                $XMLDoc = new DOMDocument();
				//Navigate up two levels in the directory structure
                chdir("..");
                chdir("..");
                $XMLDoc->load('classes.xml');

				//Create a new xml node for the professor
                $root = $XMLDoc->documentElement;
                $tempProf = $XMLDoc->createElement("professor");
                $professornamestr = $_POST['first']." ".$_POST['last'];
                $profname = $XMLDoc->createElement("name", $professornamestr);

				//Add XML for each course assigned to this professor
                for ($i = 1; $i < $_POST['courseCount'] + 1; $i++)
                {
                    $courseName = $_POST['classNumber'.$i];

                    $tempCourse = $XMLDoc->createElement("class", $courseName);
                    $tempProf->appendChild($tempCourse);
                }

				//Save the new professor back to the XML file
                $tempProf->appendChild($profname);
                $root->appendChild($tempProf);
                $XMLDoc->appendChild($root);

                echo "\n".$XMLDoc->save("classes.xml");
            }
        ?>

        <div class="footerDiv">
            <label class="footerElements"> MCS Telephone: 605-394-2471 </label>
        </div>

    </body>
</html>
