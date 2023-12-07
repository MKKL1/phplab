<?php namespace lab8;
    include_once 'Baza.php';
    include_once 'User.php';
    include_once 'UserManager.php';
    $db = new Baza("localhost", "root", "", "klienci");

    $um = new UserManager();
    if (filter_input(INPUT_GET, "akcja")=="wyloguj") {
        $um->logout($db);
    }
    if (filter_input(INPUT_POST, "zaloguj")) {
        $userId=$um->login($db);
        if ($userId > 0) {
            header("Location: testLogin.php");
        } else {
            echo "<p>Błędna nazwa użytkownika lub hasło</p>";
            $um->loginForm();
        }
    } else {
        $um->loginForm();
    }
?>