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
    var memberDiv = document.getElementById("MemberDiv");
    var newDiv = document.createElement("div");
    var divText = document.createElement("input");
    divText.type = "text";

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

window.onload = function() { LoadProfessorsAndClasses(); };
