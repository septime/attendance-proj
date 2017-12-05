function checkTeacher() {
    var opt = document.getElementById("selectList");
    var nameField = document.getElementById("teacher_name");
    var selectedValue = opt.options[opt.selectedIndex].value;
    //if a teacher is being added, show input box for entering the name 
    if (selectedValue == "teacher") {
        nameField.style.display = "block";
        nameField.style.height = "auto";
        nameField.style.marginBottom = "5px";
        nameField.required = true;
    }
    else { //if not a teacher is being added, hide the box
        nameField.style.display = "none";
        nameField.required = false;
    }
}