<?php
require_once "dbClass.php";

$db = new dbClass();

$username = $_POST['username'];

if ($db->checkUser($username))
    echo "Login successful";
else echo "Wrong user data";



?>