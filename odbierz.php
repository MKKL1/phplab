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
        //1
//        if (isset($_REQUEST['login'])&&($_REQUEST['login']!="")) {
//        $login = htmlspecialchars(trim($_REQUEST['login']));
//        echo "Login: $login <br />";
//        }
//        else echo "Nie wpisano loginu <br />";

        //2
//        foreach ($_REQUEST as $key=>$value) {
//            if(is_array($value)) {
//                print("$key = [<br/>");
//                foreach ($_REQUEST[$key] as $key2=>$value2) {
//                    print("*$key2 = $value2 <br/>");
//                }
//                print("]<br/>");
//            } else
//            print("$key = $value <br/>");
//        }
        print("Wybrano tutoriale: " . join(" ",$_REQUEST['jezyki']) . "<br/>");
        print("Sposob zaplaty: " . $_REQUEST['zaplata'] . "<br/>");
//        if (isset($_REQUEST['nazwisko'])&&($_REQUEST['nazwisko']!="") &&
//            isset($_REQUEST['wiek'])&&($_REQUEST['wiek']!="") &&
//            isset($_REQUEST['email'])&&($_REQUEST['email']!="") &&
//            isset($_REQUEST['panstwo'])&&($_REQUEST['panstwo']!=""))
//
        $doSprawdzenia = ['nazwisko','wiek','email','panstwo'];
        $poprawne = true;
        foreach ($doSprawdzenia as $value) {
            if(!isset($_REQUEST[$value]) || $_REQUEST[$value]=="") {
                $poprawne = false;
                echo "$value nie ustawione!</br>";
            }
        }
        if($poprawne) {
            $nazwisko = $_REQUEST['nazwisko'];
            $wiek = $_REQUEST['wiek'];
            $email = $_REQUEST['email'];
            $panstwo = $_REQUEST['panstwo'];

            print("<br/><a href='klient.php?nazwisko=$nazwisko&wiek=$wiek&email=$email&panstwo=$panstwo'>Dane klienta</a>");
        }
        ?>
        </div>
    </body>
</html>
