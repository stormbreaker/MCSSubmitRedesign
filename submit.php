<?php
	require 'user.php';

	if ($_FILES["file1"]["error"] > 0)
	{
		echo "A file must be selected to upload.";
	}
	else if (isset($_POST['submit']))
	{
		date_default_timezone_set("America/Denver");
        $professorName = $_POST["InstructorCombo"];
        $className = $_POST["ClassCombo"];
        $fileName = $_FILES["file1"]["name"];
		if ($professorName == "Choose Instructor" || $className == "Choose Class"
			|| $className == "------------" || $professorName == "-----------------")
		{
			echo "An instructor and class must both be selected";
		}
		$names = explode(" ", trim($professorName));

		$newFilePath = "submit/";
		$newFilePath = $newFilePath . substr($names[0], 0, 1) . substr($names[1], 0, 7) . "/";
		$newFilePath = $newFilePath . trim($className) . "/";

		if (file_exists($newFilePath))
		{
			if ($_POST["project"] == "team")
			{
				$memberCount = $_POST["memberCount"];

				for ($i = 0; $i < $memberCount; $i++)
				{
					$newFilePath = $newFilePath . $_POST["member".$i] . "_";
				}
			}

			$newFilePath = $newFilePath . User::getUsername() . "_" . date("m") . "-" . date("d") . "-" . date("y") . "_" . date("H") . "-" . date("i") . "-" . date("s") . "_" . $fileName;
			$index = 1;
			$tempFilePath = $newFilePath;

			while (file_exists($tempFilePath)) {
				$pathPieces = explode(".", $newFilePath);
				$tempFilePath = $pathPieces[0] . "(" . $index . ")" . $pathPieces[1];
				$index = $index + 1;
			}

			move_uploaded_file($_FILES["file1"]["tmp_name"], $newFilePath);
			echo "<script type='text/javascript'>alert('$fileName' + ' was successfully uploaded!');</script>";
		}
		else
		{
			echo "<script type='text/javascript'>alert('$fileName' + ' was not uploaded successfully. Please try again.');</script>";
		}
	}
?>

<html>
    <head>
        <title>Submit It!</title>
        <!-- stylesheet -->
        <link rel="stylesheet" type="text/css" href="submitstyle.css"/>
        <script type="text/javascript" src="submit.js"></script>
    </head>

    <body>
        <header>
            <div class="minesGold">
                <img src="MCS_LOGO.png" class="imageProperties"/>
                <br/>
                <div>
                    <div class="dropdown"> <a href="index.html">Home</a> </div>
                    <div class="dropdown"> <a href="sinkhole.html">Alumni</a> </div>
                    <div class="dropdown"> <a href="sinkhole.html">Directory</a> </div>
                    <div class="dropdown"> <a href="sinkhole.html">Faculty</a> </div>
                    <div class="dropdown"> <a href="sinkhole.html">Map</a> </div>
                    <div class="dropdown"> <a href="sinkhole.html">Policy</a> </div>
                    <div class="dropdown"> <a href="sinkhole.html">Program</a> </div>
                    <div class="dropdown"> <a href="sinkhole.html">Research</a> </div>

                    <div class="dropdown">
                        <a>Student</a>
                        <div class="dropdown-content" id="myDropdown">
                            <a href="sinkhole.html">Checklist</a><br/>
                            <a href="sinkhole.html">Courses</a><br/>
                            <a href="sinkhole.html">Scheduler</a>
                            <a href="submit.php">Submit It!</a>
                        </div>
                    </div>

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

        <div class="divBorder">
            <h2> Welcome to Submit It!</h2>

            <p>Please select single or team project</p>

            <form action="submit.php" method="post" enctype="multipart/form-data">
                <input type="radio" name="project" value="single" checked="checked" onchange="PickProjectType(this.value)"> Single Project </input>
                <input type="radio" name="project" value="team" onchange="PickProjectType(this.value)"> Team Project </input>

                <div name="TeamDiv" id="TeamProjectDiv" style="display:none">
                    <p>Please add your team members StudentID numbers</p>

                    <input type="button" value="Add Team Member" onclick="AddTeamMember();"/>
                    <input type="text" name="memberCount" id="memberCount" style="display:none"/>

                    <div name="MemberDiv" id="MemberDiv">
                        <!-- Where the team members will be added -->
                    </div>
                </div>

                <p>Please choose an instructor first. After an instructor is selected then choose the desired course.<br/>
                   NOTE: The course listing will only list courses taught by the selected instructor.</p>

                <select name="InstructorCombo" id="InstructorCombo" onchange="SetClasses(this)">
                    <option> Choose Instructor </option>
                    <option> ----------------- </option>
                </select>

                <select name="ClassCombo" id="ClassCombo">
                    <option> Choose Class </option>
                    <option> ------------ </option>
                </select>

                <br/>
                <br/>

            	<label for="file">Browse for file:</label>
            	<input type="file" name="file1" id="file" />
            	<br /> <br/>
            	<input type="submit" name="submit" value="Upload" />
            </form>
        </div>

        <div class="footerDiv">
            <label class="footerElements"> MCS Telephone: 605-394-2471 </label>
        </div>
    </body>
</html>
