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
            <input type="text" name="first"/>
            <label for="last">Professor's Last Name: </label>
            <input type="text" name="last"/>
            <br>
            <input type="button" value="Add Course" onclick="AddClass()"/>
            <div id="classDiv"><!--class numbers go here--></div>
            <br/>
            <br/>
            <input type="submit" name="execute" value="Add Professor and Classes"/>
            <input type="text"  name="courseCount" id="courseCount" value="0" style="display:none">
        </form>
        <?php
            if(isset($_POST['execute']))
            {
                echo "grabbing professorName: \n";
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
                    echo 'classNumber'.$i."<br>";
                    $courseName = "dammit";//$_POST['classNumber'.$i];
                    echo $courseName."<br>";
                    echo getcwd();
                    mkdir($courseName, 0755);
                }
                foreach ($_POST as $key => $value)
                {
                    echo $key."=> $value <br>";
                }
            }
            else
            {
                echo "nope";
            }
        ?>
    </body>
</html>
