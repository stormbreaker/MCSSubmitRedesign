<html>
    <head>
        <title>Submit It!</title>
        <!-- stylesheet -->
        <link rel="stylesheet" type="text/css" href="submitstyle.css"/>
    </head>

    <body>
    <!-- code for the clickable dropdown -->
        <script>
            function myFunction()
            {
                var docDisplay = document.getElementById("myDropdown").style.display;

                if (docDisplay == "none")
                {
                    document.getElementById("myDropdown").style.display = "block";
                }
                else
                {
                    document.getElementById("myDropdown").style.display = "none";
                }
            }
        </script>

        <div class="minesGold centerLR">
            <img src="SDSMT_LOGO.png" width="75"/>
            <div class="dropdown"> <a>Alumni</a> </div>
            <div class="dropdown"> <a>Directory</a> </div>
            <div class="dropdown"> <a>Faculty</a> </div>
            <div class="dropdown"> <a>Login</a> </div>
            <div class="dropdown"> <a>Map</a> </div>
            <div class="dropdown"> <a>Policy</a> </div>
            <div class="dropdown"> <a>Program</a> </div>

            <div class="dropdown">
                <a ><!--onclick="myFunction()"-->Research</a>
                <div class="dropdown-content" id="myDropdown">
                    <a href="sinkhole.html">Checklist</a><br/>
                    <a href="sinkhole.html">Courses</a><br/>
                    <a href="sinkhole.html">Scheduler</a>
                </div>
            </div>
        </div>

        <div>
            <br/>
            <br/>

            <select>
                <option> Choose Instructor </option>
                <option> ----------------- </option>
                <option> Hinker </option>
                <option> Karlsson </option>
                <option> Logar </option>
                <option> Weiss </option>
            </select>

            <select>
                <option> CSC470 </option>
                <option> CSC317 </option>
                <option> CSC300 </option>
                <option> CSC481 </option>
            </select>

            <br/>

            <button>Select File</button>
        </div>

        <form>

        </form>
    </body>
</html>