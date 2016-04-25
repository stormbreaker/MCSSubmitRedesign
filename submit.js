var xmlDoc;

function PickProjectType(radioValue)
{
    var memberDiv = document.getElementById("MemberDiv");

    if (radioValue == "single")
    {
        document.getElementById("TeamProjectDiv").style.display = "none";

        while (memberDiv.children.length != 0)
        {
            RemoveTeamMember(memberDiv.children.length - 1);
        }
    }
    else
    {
        document.getElementById("TeamProjectDiv").style.display = "block";

        AddTeamMember();
    }
}

function AddTeamMember()
{
    var countTxt = document.getElementById("memberCount");
    var memberDiv = document.getElementById("MemberDiv");
    var newDiv = document.createElement("div");
    var divText = document.createElement("input");
    divText.type = "text";
    divText.name = "member" + memberDiv.children.length;

    var divXButton = document.createElement("button");
    divXButton.appendChild(document.createTextNode("X"));

    divXButton.onclick = function()
    {
        var index = Array.prototype.indexOf.call(memberDiv.children, newDiv);

        RemoveTeamMember(index);
    }

    newDiv.appendChild(divText);
    newDiv.appendChild(divXButton);

    memberDiv.appendChild(newDiv);

    countTxt.value = memberDiv.children.length;
}

function RemoveTeamMember(numToDelete)
{
    var memberDiv = document.getElementById("MemberDiv");

    memberDiv.removeChild(memberDiv.children[numToDelete]);
}

function LoadProfessorsAndClasses()
{
    var rawFile = new XMLHttpRequest();
    rawFile.open("GET", "classes.xml", false);

    rawFile.onreadystatechange = function ()
    {
        if(rawFile.readyState === 4)
        {
            if(rawFile.status === 200 || rawFile.status == 0)
            {
                var instructCombo = document.getElementById("InstructorCombo");
                var allText = rawFile.responseText;

                var parser = new DOMParser();
                xmlDoc = parser.parseFromString(allText, "text/xml").documentElement;
                var professors = xmlDoc.querySelectorAll("professor");
                var professorNames = xmlDoc.querySelectorAll("professor name");

                for (var i = 0; i < professorNames.length; i++)
                {
                    var opt = document.createElement("option");
                    opt.value= professorNames[i].innerHTML;
                    opt.innerHTML = professorNames[i].innerHTML;

                    instructCombo.appendChild(opt);
                }
            }
        }
    }

    rawFile.send(null);
}

function SetClasses(sel)
{
    var classCombo = document.getElementById("ClassCombo");
    var professors = xmlDoc.querySelectorAll("professor");
    var classList;

    while (classCombo.children.length > 2)
    {
        classCombo.removeChild(classCombo.children[classCombo.children.length - 1]);
    }

    for (var i = 0; i < professors.length; i++)
    {
        if (professors[i].querySelector("name").innerHTML == sel.value)
        {
            classList = professors[i].querySelectorAll("class");
            break;
        }
    }

    for (var i = 0; i < classList.length; i++)
    {
        var opt = document.createElement("option");
        opt.value= classList[i].innerHTML;
        opt.innerHTML = classList[i].innerHTML;

        classCombo.appendChild(opt);
    }
}

function LoginUser()
{
    document.getElementById("LoginDiv").style.display = "none";
    document.getElementById("LoggedInDiv").style.display = "block";
    var username = document.getElementById("UserName").value;
    var loggedInDiv = document.getElementById("lblLoggedIn");

    var loginForm = document.getElementById("LoginForm");
    loginForm.submit();
}

function CheckIfUserIsLoggedIn(isLoggedIn)
{
    var postData = "isAuthenticated=true";

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

    xmlhttp.onreadystatechange = function()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            var result = xmlhttp.responseText.split(' ');

            var isAuthenticated = result[0];

            if (isAuthenticated == true)
            {
                document.getElementById("LoginDiv").style.display = "none";
                document.getElementById("LoggedInDiv").style.display = "block";

                document.getElementById("lblLoggedIn").innerHTML = "Welcome " + result[1] + "!";
            }
        }
    };

    xmlhttp.open("POST", "login.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.setRequestHeader("Content-length", postData.length);
    xmlhttp.send(postData);
}

window.onload = function()
{
    CheckIfUserIsLoggedIn();

    LoadProfessorsAndClasses();
};
