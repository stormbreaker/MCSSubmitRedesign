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

function AddCourseDataXML()
{
    var rawFile = new XMLHttpRequest();
    rawFile.open("GET", "classes.xml", false);

    rawFile.onreadystatechange = function ()
    {
        if(rawFile.readyState === 4)
        {
            if(rawFile.status === 200 || rawFile.status == 0)
            {
                var allText = rawFile.responseText;

                var parser = new DOMParser();
                xmlDoc = parser.parseFromString(allText, "text/xml");//.documentElement;


                var root = xmlDoc.getElementsByTagName("prof-course");

                //gets to this point

                var professorFirst = document.getElementById("first").value;
                var professorLast = document.getElementById("last").value;
                var courseCount = document.getElementById("courseCount");



                var folderstruct = xmlDoc.createElement("professor");


                var name = xmlDoc.createElement("name");
                name.innerHTML = professorFirst + " " + professorLast;


                folderstruct.appendChild(name);

                for (var i = 1; i < courseCount.value + 1; i++)
                {
                    //fails on following line
                    var classNumber = document.getElementById("classNumber" + i.toString());
                    var classitem = xmlDoc.createElement("class");
                    document.write(i.toString());
                    classitem.innerHTML = classNumber.value;
                    document.write("almost done");

                    folderstruct.appendChild(classitem);
                }
                root.appendChild(folderstruct);

            }
        }
    }

    rawFile.send(null);
    document.write("DONE!");
}

window.onload = function () { AddClass(); };
