<?php
require_once("dbClass.php");

$db=new dbClass();

$courses = $db->getListOfCourses('אורנשטיין טטיאנה');

print(json_encode($courses));

?>