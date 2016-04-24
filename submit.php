<?php
	require 'user.php';

	if ($_FILES["file1"]["error"] > 0)
	{
		echo "ERROR";
	}
	else if (isset($_POST['submit']))
	{
        $fileName = $_FILES["file1"]["name"];
        $professorName = $_POST["InstructorCombo"];
        $className = $_POST["ClassCombo"];
		$newFilePath = "submit/" . $professorName . "/" . $className . "/";
        
		if (file_exists($newFilePath) == false)
		{
			mkdir($newFilePath, 0755, true);
		}

		$newFilePath = $newFilePath . "/" . User::getUsername();

        if ($_POST["project"] == "team")
        {
            $memberCount = $_POST["memberCount"];

            for ($i = 0; $i < $memberCount; $i++)
            {
                $newFilePath = $newFilePath."_".$_POST["member".$i];
            }
        }

        $newFilePath .= "_" . date("d") . "_" . date("m") . "_" . date("y") . "_" . date("H") . ":" . date("i") . ":" . date("s") . "_" . $fileName;

		$tempFilePath = $newFilePath;
		$canUpload = 1;
		$index = 1;
		while (file_exists($tempFilePath)) {
			$tempFilePath = $newFilePath . "(" . $index . ")";
			$index = $index + 1;
		}
		$newFilePath = $tempFilePath;
		move_uploaded_file($_FILES["file1"]["tmp_name"], $newFilePath);

        echo "<script type='text/javascript'>alert('$fileName' + ' was successfully uploaded!');</script>";
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

        <div>
            <h2> Welcome to Submit It!</h2>

            <p>Please select single or team project</p>

            <form action="submit.php" method="post" enctype="multipart/form-data">
                <input type="radio" name="project" value="single" checked="checked" onchange="PickProjectType(this.value)"> Single Project </input>
                <input type="radio" name="project" value="team" onchange="PickProjectType(this.value)"> Team Project </input>

                <div name="TeamDiv" id="TeamProjectDiv" style="display:none">
                    <p>Please add your team members StudentID numbers</p>

                    <input type="button" value="Add Team Member" onclick="AddTeamMember()"/>
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
    </body>
</html>
