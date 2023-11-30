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

include_once "Baza.php";
include_once "User.php";
include_once "RegistrationForm.php";

$bd = new Baza("localhost", "root", "", "klienci");

$regFrom = new RegistrationForm();

if(filter_input(INPUT_POST, 'submit')) {
    $user = $regFrom->checkUser();
    if($user===NULL) {
        echo "<p>Niepoprawne dane rejestracji</p>";
    } else {
        echo "<p>Poprawne dane rejestracji</p>";
        $user->saveDB($bd);
        echo $user->getAllUsersFromDB($bd);
    }
}
?>
</body>
</html>
