<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
    include_once 'User.php';
    $user1 = new User('kp', 'Kubus Puchatek', 'kubus@stumilowylas.pl', 'nielubietygryska');
    $user1->show();
?>
</body>
</html>
