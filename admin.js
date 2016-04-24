function AddClass()
{
    var memberDiv = document.getElementById("classDiv");
    var newDiv = document.createElement("div");
    var divText = document.createElement("input");
    var courseCounter = document.getElementById("courseCount");
    courseCounter.value = parseInt(courseCounter.value) + 1;
    divText.type = "text";
    divText.name = "classNumber" + courseCounter.value;

    var divXButton = document.createElement("button");
    divXButton.appendChild(document.createTextNode("X"));

    divXButton.onclick = function()
    {
        var index = Array.prototype.indexOf.call(memberDiv.children, newDiv);

        RemoveClass(index);
    }

    newDiv.appendChild(divText);
    newDiv.appendChild(divXButton);


    memberDiv.appendChild(newDiv);
}

function RemoveClass(numToDelete)
{
    var classDiv = document.getElementById("classDiv");

    var courseCount = document.getElementById("courseCount");
    courseCount.value = parseInt(courseCount.value) - 1;

    classDiv.removeChild(classDiv.children[numToDelete]);
}

window.onload = function () { AddClass(); };
