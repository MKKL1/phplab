<?php  namespace lab8;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Test Login</title>
</head>
<body>
<?php
include_once "classes/Baza.php";
include_once "classes/User.php";
include_once "classes/LoggedUserManager.php";

$bd = Baza::getInstance("mysql:host=localhost;dbname=klienci", "root", "");

$um = new LoggedUserManager();
session_start();
if(!$um->isLoggedIn($bd)) {
    echo "<p>Nie jesteś zalogowany</p>";
    echo "<a href='index.php' >Zaloguj się</a> </p>";
} else {
    echo "<p>Jesteś zalogowany!</p>";
    $userId = $um->getLoggedInUser($bd, session_id());
    if ($userId >= 0) {
        $sql = "SELECT * FROM users WHERE id='$userId'";
        if ($result = $bd->query($sql)) {
            $ile = $result->rowCount();
            if ($ile == 1) {
                $row = $result->fetchObject();
                var_dump($row);
            }
        }
    }
    echo "<p><a href='index.php?akcja=wyloguj' >Wyloguj</a> </p>";
}
?>
</body>
</html>
