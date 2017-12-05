<?php
require_once "./random_compat/lib/random.php";
require_once("dbClass.php");
require_once("User.php");

$db=new dbClass();
$user = new User();

try {
    $string = random_bytes(5);
} catch (TypeError $e) {
    // Well, it's an integer, so this IS unexpected.
    die("An unexpected error has occurred"); 
} catch (Error $e) {
    // This is also unexpected because 32 is a reasonable integer.
    die("An unexpected error has occurred");
} catch (Exception $e) {
    // If you get this message, the CSPRNG failed hard.
    die("Could not generate a random string. Is our OS secure?");
}

var_dump(bin2hex($string));


$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDBPDO";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // sql to delete a record
    $sql = "DELETE FROM MyGuests WHERE id=3";

    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Record deleted successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>