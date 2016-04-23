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
    newDiv.className = "teamMember";

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
