<?php
require_once("dbClass.php");


if (isset($_FILES['files'])&&strlen($_FILES['files']['name'][0])>0) { //if there are files uploaded
    $db=new dbClass();
    $success = array();
    $fail = array();
    
    $filescount = count($_FILES['files']['name']); //number of uploaded files

    $files = renameFiles($filescount); //rename uploaded files 
    
    $tables = getArray($filescount,$files); //explode the csv files into 'tables' array

    if(isset($_POST['loadTimetable'])) { //if "upload timetable" button has been clicked
        loadTimetables($files,$filescount,$tables,$success,$fail,$db);
    }//end of loading timetable
    
    if(isset($_POST['loadStudents'])) { //if "upload students" button has been clicked
        LoadStudents($files,$filescount,$tables,$success,$fail,$db);
    }//end of loading students
    
    //provide user with a relevant message
    showMessage($success,$fail,$files);
    
} //end of check whether there are any files uploaded
    

//rename uploaded files
function renameFiles($filescount) {
    for ($i=0;$i<$filescount;$i++) {
        $files[] = $_FILES['files']['name'][$i];
        move_uploaded_file($_FILES['files']['tmp_name'][$i],$files[$i]);
    }
    return $files;
}

//get an array of files
function getArray($filescount,$files) {
    for ($i=0;$i<$filescount;$i++) {
        $tables[] = array_map('str_getcsv', file($files[$i]));
    }
    return $tables;
}

//check that files are in a required format
function checkFormat($format,$tables,$k,$d) {
    $n = count($tables[$k][$d]);
        for ($i=0;$i<$n;$i++) {
            $headings[] = $tables[$k][$d][$i];
        }
    return $headings;
}


//load timetables
function LoadTimetables($files,$filescount,$tables,&$success,&$fail,$db) {
    $checkT = array('קוד מלא', 'שם קורס', 'תקופה', 'מרצים', 'לומדים', 'קבוצה', 'מועד', 'סה"כ שעות', 'ששנ"ת', 'שעות', 'חדר', 'שם');
        for ($k=0;$k<$filescount;$k++) {
            $headings = checkFormat($checkT,$tables,$k,0); //check that files are in a required format
            if (empty(array_diff($checkT,$headings))) {
                addFiles($files,$tables,$success,$fail,$db,$k); //add files to the database
                }
            else {
                echo "<div class='alert alert-danger alert-dismissable' style='margin-top:20px;'><a href='#' class='close' data-dismiss='alert' aria-label='close'>x</a>קובץ $files[$k] לא בפורמט נוכן</div>";
                }
            }
}

//add timetable files' content to the database
function addFiles($files,$tables,&$success,&$fail,$db,$i) {
        $rows = count($tables[$i]); //number of rows in a table
        //rows 0 of the files contain headings which do not go into the database
        $group = $tables[$i][1][5]; //group name
            if (!$db->checkTimetable($group)) { //if the timetable doesn't exist yet
                for ($j=1;$j<$rows;$j++) {
                    $teachers = explode(',',$tables[$i][$j][3]); //get the teachers
                    $t_num = count($teachers); //get number of teachers
                    addLine($t_num,$tables,$teachers,$i,$j,$db); //add line to the DB
                }
                $success[] = $files[$i]; //save file name as successfully uploaded
            }
            else { //the timetable already exists
                $fail[] = $files[$i]; //save file name as failed to upload
            }
        
}
//add a new line to timetables database
function addLine($num,$tables,$teachers,$i,$j,$db) {
    for ($k=0;$k<$num;$k++) { //for the number of teachers
        $timeofday = explode(' ',$tables[$i][$j][6]);
        $timescount = count($timeofday);
        for ($n=0;$n<$timescount;$n++) { //for the number of times per week
            $dayofweek = explode("'",$timeofday[$n]);
            $daycount = count($dayofweek);
            for ($m=0;$m<$daycount;$m+=2){ //separate day of the week and time of the class
                $day = convertDay($dayofweek[$m]); //convert to English representation
                //add line to the database
                $t = new Timetable();
                $t->setCourseCode($tables[$i][$j][0]);
                $t->setCourseName($tables[$i][$j][1]);
                $t->setSemester($tables[$i][$j][2]);
                $t->setTeacherName($teachers[$k]);
                $t->setGroup($tables[$i][$j][5]);
                $t->setDay($day);
                $t->setTime($dayofweek[++$m]);
                $t->setTotal($tables[$i][$j][7]);
                $db->addTimetable($t); 
            }
        }
    }
}
//convert day from Hebrew representation into English
function convertDay($day) {
    switch ($day) {
        case "א": 
            $day = "Sunday";
            break;
        case "ב":
            $day = "Monday";
            break;
        case "ג":
            $day = "Tuesday";
            break;
        case "ד":
            $day = "Wednesday";
            break;
        case "ה":
            $day = "Thursday";
            break;
        case "ו":
            $day = "Friday";
            break;
    }
    return $day;
}

//load students 
function LoadStudents($files,$filescount,$tables,&$success,&$fail,$db) {
    $checkS = array("מס'","ת.ז","שם משפחה","שם פרטי");
        for ($k=0;$k<$filescount;$k++) {
            $headings = checkFormat($checkS,$tables,$k,2); //check that files are in a required format
           if(empty(array_diff($checkS,$headings))) { //file in the correct format
               addStudents($files,$tables,$success,$fail,$db,$k); //add students to the db
           }
            else {
                echo "<div class='alert alert-danger alert-dismissable' style='margin-top:20px;'><a href='#' class='close' data-dismiss='alert' aria-label='close'>x</a>קובץ $files[$k] לא בפורמט נוכן</div>";
                }
        }//end of for
}
//add students to the database
function addStudents($files,$tables,&$success,&$fail,$db,$k) {
    $group = $tables[$k][3][0];
    $rows = count($tables[$k]);
    if (!$db->checkStudent($group)) { //if this group is not in the database yet
    for ($i=4;strpos($tables[$k][$i][0],'תלמידים')!=true;$i++) { //we haven't reached the end of list yet
        st_addLine($db,$k,$i,$tables,$group);
    }
    $i+=2; //check whether there are mashlimim
    if (!empty($tables[$k][$i][0])){ //if there are more students studying with this group
        while (strpos($tables[$k][$i][0],'תלמידים')!=true) {
            st_addLine($db,$k,$i,$tables,$group);
            $i++;
            }
        }
        $success[] = $files[$k]; //save file name as successfully uploaded
    }
    else {
        $fail[] = $files[$k]; //save file name as failed to upload
    }
}
//add a new line to students table
function st_addLine($db,$k,$i,$tables,$group) {
    $s = new Student();
        $s->setID($tables[$k][$i][1]);
        $s->setGroup($group);
        $s->setFirstName($tables[$k][$i][2]);
        $s->setLastName($tables[$k][$i][3]);
        $db->addStudent($s);
}

//show message
function showMessage($success,$fail,$files) {
    $count_success = count($success);
    $count_fail = count($fail);
        if ($count_success>0) {
            for ($i=0;$i<$count_success;$i++) {
            echo "<div class='alert alert-success alert-dismissable' style='margin-top:20px;'><a href='#' class='close' data-dismiss='alert' aria-label='close'>x</a>קובץ $files[$i] הועבר לשרת בהצלח</div>";
            }
        }
        if ($count_fail>0) {
        for ($i=0;$i<$count_fail;$i++) {
            echo "<div class='alert alert-danger alert-dismissable' style='margin-top:20px;'><a href='#' class='close' data-dismiss='alert' aria-label='close'>x</a>לא ניתן היה להעלות קובץ $files[$i] לשרת, קובץ כבר קיים בבסיס הנתונים</div>";
            }
        }
}


?>