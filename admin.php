<html>
    <head>
        <title>
            Class Administration
        </title>
        <script type="text/javascript" src="admin.js"></script>
    </head>
    <body>
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
                //echo "grabbing professorName: \n";
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
                    //echo 'classNumber'.$i."<br>";
                    $courseName = $_POST['classNumber'.$i];
                    //echo $courseName."<br>";
                    //echo getcwd();
                    mkdir($courseName, 0755);
                }
                $XMLDoc = new DOMDocument();
                chdir("..");
                chdir("..");
                $XMLDoc->load('classes.xml');

                //echo $XMLDoc->saveXML();
                $root = $XMLDoc->documentElement;

                $tempProf = $XMLDoc->createElement("professor");

                $professornamestr = $_POST['first']." ".$_POST['last'];

                $profname = $XMLDoc->createElement("name", $professornamestr);


                for ($i = 1; $i < $_POST['courseCount'] + 1; $i++)
                {
                    //echo 'classNumber'.$i."<br>";
                    $courseName = $_POST['classNumber'.$i];
                    //echo $courseName."<br>";
                    //echo getcwd();

                    $tempCourse = $XMLDoc->createElement("class", $courseName);
                    $tempProf->appendChild($tempCourse);


                }
                $tempProf->appendChild($profname);
                $root->appendChild($tempProf);

                $XMLDoc->appendChild($root);

                echo "\n".$XMLDoc->save("classes.xml");


                /*
                foreach ($_POST as $key => $value)
                {
                    echo $key."=> $value <br>";
                }
                */
            }
            else
            {
                echo "nope";
            }
        ?>
    </body>
</html>
