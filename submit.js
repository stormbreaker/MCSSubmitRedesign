var xmlDoc; // Variable to hold xmlDoc as to not have to request it over and over

function PickProjectType(radioValue)
{
    // Get team member div
    var memberDiv = document.getElementById("MemberDiv");

    if (radioValue == "single")
    {
        // Hide team project div if single project was selected
        document.getElementById("TeamProjectDiv").style.display = "none";

        // Remove all team members from the list
        while (memberDiv.children.length != 0)
        {
            RemoveTeamMember(memberDiv.children.length - 1);
        }
    }
    else
    {
        // Show the team project div if team project was selected
        document.getElementById("TeamProjectDiv").style.display = "block";

        // Call function to add new team member to the div
        AddTeamMember();
    }
}

function AddTeamMember()
{
    // Get all needed elements from the document
    var countTxt = document.getElementById("memberCount");
    var memberDiv = document.getElementById("MemberDiv");
    var newDiv = document.createElement("div");
    var divText = document.createElement("input");

    // Set the type of object divText is and name the element
    divText.type = "text";
    divText.name = "member" + memberDiv.children.length;

    // Create button to allow deletion of team members
    var divXButton = document.createElement("button");
    divXButton.appendChild(document.createTextNode("X"));

    // When the button is clicked, this function is called
    divXButton.onclick = function()
    {
        // Get index of the child element
        var index = Array.prototype.indexOf.call(memberDiv.children, newDiv);

        // Remove element at that index
        RemoveTeamMember(index);
    }

    // Add text box and x button to the div
    newDiv.appendChild(divText);
    newDiv.appendChild(divXButton);

    // Add div to the team members div
    memberDiv.appendChild(newDiv);

    // Set invisible text box value to the length
    // Invisible used for know how many team members are used when submitting form
    countTxt.value = memberDiv.children.length;
}

function RemoveTeamMember(numToDelete)
{
    // Get team member div element
    var memberDiv = document.getElementById("MemberDiv");

    // Remove specific team member from the div
    memberDiv.removeChild(memberDiv.children[numToDelete]);
}

function LoadProfessorsAndClasses()
{
    // Create XMLHttpRequest and GET the classes.xml file
    var rawFile = new XMLHttpRequest();
    rawFile.open("GET", "classes.xml", false);

    // When the file is loaded this function is called
    rawFile.onreadystatechange = function ()
    {
        if(rawFile.readyState === 4)
        {
            if(rawFile.status === 200 || rawFile.status == 0)
            {
                // Get the instructor combo box to fill later
                var instructCombo = document.getElementById("InstructorCombo");
                var allText = rawFile.responseText;

                // Create DOMParser to parse through the xml data
                var parser = new DOMParser();
                xmlDoc = parser.parseFromString(allText, "text/xml").documentElement;

                // Select all professors names from the list
                var professorNames = xmlDoc.querySelectorAll("professor name");

                // Loop through professors and add them to combo box
                for (var i = 0; i < professorNames.length; i++)
                {
                    var opt = document.createElement("option");
                    opt.value= professorNames[i].innerHTML;
                    opt.innerHTML = professorNames[i].innerHTML;

                    // Add professor to the combo box
                    instructCombo.appendChild(opt);
                }
            }
        }
    }

    // Send off to get the file
    rawFile.send(null);
}

function SetClasses(sel)
{
    // Get appropriate objects and get the professors names
    var classCombo = document.getElementById("ClassCombo");
    var professors = xmlDoc.querySelectorAll("professor");
    var classList;

    // Remove the classes that were already loaded into the combo box
    while (classCombo.children.length > 2)
    {
        classCombo.removeChild(classCombo.children[classCombo.children.length - 1]);
    }

    // Loop through to get professors classes
    for (var i = 0; i < professors.length; i++)
    {
        if (professors[i].querySelector("name").innerHTML == sel.value)
        {
            // Get all classes that a certain professor teaches
            classList = professors[i].querySelectorAll("class");
            break;
        }
    }

    // Create option elements for all classes
    for (var i = 0; i < classList.length; i++)
    {
        var opt = document.createElement("option");
        opt.value= classList[i].innerHTML;
        opt.innerHTML = classList[i].innerHTML;

        // Add option to the combo box
        classCombo.appendChild(opt);
    }
}

function LoginUser()
{
    // Hide login boxes and show not logged in label
    document.getElementById("LoginDiv").style.display = "none";
    document.getElementById("LoggedInDiv").style.display = "block";

    // Submit the form to the server
    var loginForm = document.getElementById("LoginForm");
    loginForm.submit();
}

function CheckIfUserIsLoggedIn(isLoggedIn)
{
    var postData = "isAuthenticated=true";

    // Create either XMLHttpRequest or ActiveXObject to get if the user is authenticated
    if (window.XMLHttpRequest)
    {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    }
    else
    {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    // When the server calls us back, parse the data and handle appropriately
    xmlhttp.onreadystatechange = function()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            // Data is coming back as "isAuthenticated username"
            var result = xmlhttp.responseText.split(' ');

            // Get whether the user is authenticated
            var isAuthenticated = result[0];

            if (isAuthenticated == true)
            {
                // Hide login boxes and show welcome label
                document.getElementById("LoginDiv").style.display = "none";
                document.getElementById("LoggedInDiv").style.display = "block";

                // If user is logged in, show "Welcome username!"
                document.getElementById("lblLoggedIn").innerHTML = "Welcome " + result[1] + "!";
            }
        }
    };

    // Setup and send xmlhttp request to get the authentication info
    xmlhttp.open("POST", "login.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.setRequestHeader("Content-length", postData.length);
    xmlhttp.send(postData);
}

// Set window onload function to set up certain parts of the Web page
window.onload = function()
{
    // First check if user is logged in
    CheckIfUserIsLoggedIn();

    // Load professors and classes
    LoadProfessorsAndClasses();
};
