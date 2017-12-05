<?php
require_once("dbClass.php");

if (isset($_POST['showStudent'])&&strlen($_POST['id'])>0) {
    $db = new dbClass();
    $id = $_POST['id'];
    
    //check that the student exists in the DB
    if (!$db->studentExists($id)) { //student doesn't exist
        echo "<div class='alert alert-danger alert-dismissable' style='margin-top:20px;'><a href='#' class='close' data-dismiss='alert' aria-label='close'>x</a>סטודנט עם ת.ז. $id לא נמצא במערכת</div>";
    }
    else { //student exists
        $classes = $db->getAbsence($id);

        $rows = count($classes);
        $table = "<hr><form action='' method='post' class='form'><p style='margin-top:10px;'>סטודנט $id</p>";
        $table .= "<table class='table table-bordered table-responsive'><tr><th>שיעור</th><th>תאריך</th><th>סמנ/י כנמצא</th></tr>";
        for ($i=0;$i<$rows;$i++) {
            $class = $classes[$i]['class_name'];
            $table .= "<tr><td>$class";
            $date = $classes[$i]['date'];
            $table .= "<td>$date</td>";
            $table .= "<td><input type='checkbox' name=checked[] value=$class></td></tr>";
        }
        $table .= "</table><button class='btn btn-primary btn-lg' type='submit' name='changeAttendance'>לבצע שינויים</button></form>";
        echo $table;  
    }
}

/*
if (isset($_POST['changeAttendance'])&&isset($_POST['checked'])) {
    $classes = $_POST['checked'];
    if (!empty($classes)) {
        echo "<pre>";
        print_r($classes);
        echo "</pre>";
    }
}
*/
?>