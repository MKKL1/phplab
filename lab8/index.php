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

include_once "Baza.php";
include_once "User.php";
include_once "UserManager.php";

$bd = new Baza("localhost", "root", "", "klienci");

$userMng = new UserManager();
$userMng->loginForm();
?>
</body>
</html>
