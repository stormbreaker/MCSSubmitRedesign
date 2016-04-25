function AddClass()
{
	//Get HTML fields
    var memberDiv = document.getElementById("classDiv");
    var newDiv = document.createElement("div");
    var divText = document.createElement("input");
    var courseCounter = document.getElementById("courseCount");
    courseCounter.value = parseInt(courseCounter.value) + 1;
    divText.type = "text";
    divText.name = "classNumber" + courseCounter.value;

	//Create new button
    var divXButton = document.createElement("button");
    divXButton.appendChild(document.createTextNode("X"));

	//Define button event handler
    divXButton.onclick = function()
    {
        var index = Array.prototype.indexOf.call(memberDiv.children, newDiv);

        RemoveClass(index);
    }

	//Add the new button to the page
    newDiv.appendChild(divText);
    newDiv.appendChild(divXButton);

    memberDiv.appendChild(newDiv);
}

function RemoveClass(numToDelete)
{
	//Removes one of the new course lines from the html
    var classDiv = document.getElementById("classDiv");

    var courseCount = document.getElementById("courseCount");
    courseCount.value = parseInt(courseCount.value) - 1;

    classDiv.removeChild(classDiv.children[numToDelete]);
}

function AddCourseDataXML()
{
	//Open the xml file
    var rawFile = new XMLHttpRequest();
    rawFile.open("GET", "classes.xml", false);

    rawFile.onreadystatechange = function ()
    {
		//File is ready
        if(rawFile.readyState === 4)
        {
            if(rawFile.status === 200 || rawFile.status == 0)
            {
                var allText = rawFile.responseText;

				//Parse the text of the XML file
                var parser = new DOMParser();
                xmlDoc = parser.parseFromString(allText, "text/xml");

				//Get details of a professor entry
                var root = xmlDoc.getElementsByTagName("prof-course");
                var professorFirst = document.getElementById("first").value;
                var professorLast = document.getElementById("last").value;
                var courseCount = document.getElementById("courseCount");

                var folderstruct = xmlDoc.createElement("professor");
                var name = xmlDoc.createElement("name");

                name.innerHTML = professorFirst + " " + professorLast;
                folderstruct.appendChild(name);

				//Each class assigned to this professor
                for (var i = 1; i < courseCount.value + 1; i++)
                {
					//Write the contents to the file
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
