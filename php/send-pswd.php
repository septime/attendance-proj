<?php
require_once("dbClass.php");
$db = new dbClass();

if(isset($_POST['send'])) {
    $email = $_POST['email'];
    
    if ($db->checkUser($email)) { //if the user exists in the database
        //generate password
        $string = random_bytes(4);
        $pswd = bin2hex($string);
        
        $pswd = password_hash($pswd,PASSWORD_DEFAULT); //hash password
        
        $db->updatePswd($pswd,$email); //save updated password in the DB
        
        sendMail($email,$pswd); //send generated password to the provided email
            
        //inform the user that the new password was sent    
        echo "<div class='alert alert-success alert-dismissable' dir='ltr' style='max-width:300px; margin: 0 auto;'><a href='#' class='close' data-dismiss='alert' aria-label='close'>x</a>New password sent successfully!</div>";
        }
    else //the user doesn't exist in the DB
            echo "<div class='alert alert-danger alert-dismissable' dir='ltr' style='max-width:300px; margin: 0 auto;'><a href='#' class='close' data-dismiss='alert' aria-label='close'>x</a>User $email does not exist in the database!</div>";
        }

function sendMail($email,$pswd) {
        //send generated password to the provided email
        $subject = 'ברוכים הבאים למערכת ניהול נוכחות';
        $message = "סיסמה שלך לכניסה למערכת: $pswd";
        $headers = 'From: webmaster@example.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
        mail($email, $subject, $message, $headers);
    }
?>