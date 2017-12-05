<?php
require_once("dbClass.php");
$db = new dbClass();



                            
if(isset($_POST['enter'])) {
    $email = $_POST['email'];
    $pswd = $_POST['pswd'];
    $id = $db->getIDbyEmail($email);
    $db_pswd = $db->getPasswordbyEmail($email);
    
    if (password_verify($pswd,$db_pswd)) {
        if (isset($_POST['remember-me'])) {
            //set cookie to last 1 year 
            setcookie('username', $email, time()+60*60*24*365,"/");
            setcookie('password', md5($pswd), time()+60*60*24*365,"/");
        
        } else {
            //cookie expires when browser closes 
            setcookie('username', $email, false);
            setcookie('password', md5($pswd), false);
            }
        if($id==1){ //admin
        header("Location: ../html/admin.php");
        }
        if($id==2){ //secretaries
        header("Location: ../html/reports.html");
        }
        if($id==3 || $id==4){ //teachers and management
        header("Location: ../html/reports_view.html");
        }
    }
    else { //if the password is wrong - stay on login page
        require_once("../html/index.html");
    }
    
}


?>