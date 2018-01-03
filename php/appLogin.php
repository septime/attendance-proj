<?php
require "dbClass.php";

$db = new dbClass();

$username = $_POST['username'];

if ($db->checkUser)
    echo "Login successful";
else echo "Wrong user data";



?>