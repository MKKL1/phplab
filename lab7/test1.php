<?php  namespace lab7;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lab5</title>
</head>
<body>
<?php
include_once "User.php";

session_start();
$user = new User('Kubus1', 'Kubus Puchatek', 'kubus@stumilowylas.pl', 'tajnehaslo');
$_SESSION['user'] = serialize($user);

echo 'ID ', $_COOKIE['PHPSESSID'], '</br>';

unserialize($_SESSION['user'])->show();
?>
</br>
<a href="test2.php">test2</a>
</body>
</html>