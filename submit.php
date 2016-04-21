<html>
    <head>
        <title>Submit It!</title>

        <style>
            .dropbtn {
                display: inline-block;
                color: white;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
            }

            .dropdown {
                display: inline-block;
            }

            .dropdown-content {
                display: none;
                position: absolute;
                background-color: #f9f9f9;
                min-width: 160px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            }

            .dropdown-content button{
                display: block;
                padding: 10px 10px;
            }
        </style>
    </head>

    <body>
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

        <div>
            <img src="SDSMT_LOGO.png" width="75"/>
            <div class="dropdown"> <a>Alumni</a> </div>
            <div class="dropdown"> <a>Directory</a> </div>
            <div class="dropdown"> <a>Faculty</a> </div>
            <div class="dropdown"> <a>Login</a> </div>
            <div class="dropdown"> <a>Map</a> </div>
            <div class="dropdown"> <a>Policy</a> </div>
            <div class="dropdown"> <a>Program</a> </div>

            <div class="dropdown">
                <a onclick="myFunction()">Research</a>
                <div class="dropdown-content" id="myDropdown">
                    <a>Checklist</a><br/>
                    <a>Courses</a><br/>
                    <a>Scheduler</a>
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
