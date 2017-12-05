<?php
require_once("dbClass.php");
require_once("User.php");

$db=new dbClass();
$user = new User();
$teacherFlag = false;



//adding user to the database
if(isset($_POST['addUser'])) { //if "add user" button has been clicked
   
    //if email and privileges have been provided
    if (strlen($_POST['email_add'])>0) {
        
        $option = $_POST['privilege']; //save privileges
        $email=$_POST['email_add']; //save email
        
        //if the user does not exist in the database
        if (!$db->checkUser($email)) {
        //generate password
        $string = random_bytes(4);
        $pswd = bin2hex($string);
        $user->setEmail($email);
            
        //save hashed password
        $user->setPassword(password_hash($pswd,PASSWORD_DEFAULT));
            
        //set group ID
        if($option=='secretary') {
            $user->setID(2);
        }
        if($option=='teacher') {
            $user->setID(3);
            $user->setName($_POST['teacher']);
            $teacherFlag = true;
        }
        if($option=='management') {
            $user->setID(4);
        }
            
        $db->addUser($user); //add user to the database
            
        if ($teacherFlag) {
            $db->addTeacherName($user->getName(),$email);
        }
            
        sendMail($email,$pswd); //send generated password to the provided email
            
        //inform admin that addition succeeded      
        echo "<div class='alert alert-success alert-dismissable' dir='ltr' style='max-width:300px; margin: 0 auto;'><a href='#' class='close' data-dismiss='alert' aria-label='close'>x</a>User $email $pswd added successfully!</div>";
        }
        else //the user exists
            echo "<div class='alert alert-danger alert-dismissable' dir='ltr' style='max-width:300px; margin: 0 auto;'><a href='#' class='close' data-dismiss='alert' aria-label='close'>x</a>User $email already exists in the database!</div>";
        }
}


function sendMail($email,$pswd) {
        //send generated password to the provided email
        $subject = 'ברוכים הבאים למערכת ניהול נוכחות';
        $message = "סיסמה שלך לכניסה למערכת: $pswd";
        $headers = 'From: webmaster@example.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
        mail($email, $subject, $message, $headers);
    }

//deleting user from the database
if(isset($_POST['deleteUser'])){ //if "delete user" button has been clicked
    if (strlen($_POST['email_del'])>0){ //if email has been provided
        $email = $_POST['email_del']; //save email
        //if the user exists in the database
        if ($db->checkUser($email)) {
            $db->deleteUser($email); //delete user from the database
        echo "<div class='alert alert-success alert-dismissable' dir='ltr' style='max-width:300px; margin: 0 auto;'><a href='#' class='close' data-dismiss='alert' aria-label='close'>x</a>User $email deleted successfully!</div>";
        }
        else //the user doesn't exist
            echo "<div class='alert alert-danger alert-dismissable' dir='ltr' style='max-width:300px; margin: 0 auto;'><a href='#' class='close' data-dismiss='alert' aria-label='close'>x</a>User $email does not exist in the database!</div>";
    }
}

?>