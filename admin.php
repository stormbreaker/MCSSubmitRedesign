<html>
    <head>
        <title>
            Class Administration
        </title>
        <script type="text/javascript" src="admin.js"></script>
    </head>
    <body>
		<!--The html elements for professor and class administration-->
        <form action="admin.php" method="post">
            <label for="first">Professor's First Name: </label>
            <input type="text" name="first" id="first"/>
            <label for="last">Professor's Last Name: </label>
            <input type="text" name="last" id="last"/>
            <br>
            <input type="button" value="Add Course" onclick="AddClass()"/>
            <div id="classDiv"><!--class numbers go here--></div>
            <br/>
            <br/>
            <input type="submit" name="execute" value="Add Professor and Classes" onclick="AddCourseDataXML()"/>
            <input type="text"  name="courseCount" id="courseCount" value="0" style="display:none">
            <input type="button" name="updatexml" id="updatexml" value="Update XML Doc" onclick="AddCourseDataXML()"/>
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
                $XMLDoc = ne1w DOMDocument();
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
    </body>
</html>
