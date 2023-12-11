<?php  namespace lab8;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lab5</title>
</head>
<body>
<?php

use lab8\classes\Baza;
use lab8\classes\UserManager;

include_once "Baza.php";
include_once "User.php";
include_once "UserManager.php";

$bd = new Baza("localhost", "root", "", "klienci");

$um = new UserManager();
session_start();
$userId = $um->getLoggedInUser($bd, session_id());
if($userId >= 0) {
    $sql = "SELECT * FROM users WHERE id='id'";
    if ($result = $bd->query($sql)) {
        $ile = $result->num_rows;
        if ($ile == 1) {
            $row = $result->fetch_object();
            echo $row;
        }
    }
}
echo "<a href='classes/processLogin.php?akcja=wyloguj' >Wyloguj</a> </p>";
?>
</body>
</html>
