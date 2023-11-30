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
echo 'ID ', $_COOKIE['PHPSESSID'], '</br>';
unserialize($_SESSION['user'])->show();

session_destroy();
?>
</br>
<a href="test1.php">test1</a>
</body>
</html>