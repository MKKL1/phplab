<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lab5</title>
</head>
<body>
<?php
    include_once 'User.php';
    include_once 'RegistrationForm.php';
    $rf = new RegistrationForm();
    //if(filter_input(INPUT_POST, 'submit')) {
        $user = $rf->checkUser();
        if($user===NULL) {
            echo "<p>Niepoprawne dane rejestracji</p>";
        } else {
            echo "<p>Poprawne dane rejestracji</p>";
            $user->show();
            $user->save();
            $user->saveXML();
        }
    //}

    User::getAllUsers();
    User::getAllUsersFromXML();
?>
</body>
</html>
