<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div>
        <h2>Dane odebrane z formularza:</h2>
        <?php
        if (isset($_REQUEST['login'])&&($_REQUEST['login']!="")) {
        $login = htmlspecialchars(trim($_REQUEST['login']));
        echo "Login: $login <br />";
        }
        else echo "Nie wpisano loginu <br />";
        ?>
        </div>
    </body>
</html>
