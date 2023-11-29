<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lab5</title>
</head>
<body>
<?php

include "formularz.php";
include_once "Baza.php";

$bd = new Baza("localhost", "root", "", "klienci");
function dodajdoBD(Baza $bd)
{
    $args = [
        'nazwisko' => ['filter' => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '/^[A-Z]{1}[a-ząęłńśćźżó-]{1,25}$/']],
        'wiek' => ['filter' => [FILTER_VALIDATE_INT, FILTER_SANITIZE_FULL_SPECIAL_CHARS]],
        'email' => ['filter' => [FILTER_VALIDATE_EMAIL, FILTER_SANITIZE_FULL_SPECIAL_CHARS]],
        'panstwo' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'jezyki' => ['filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'flags' => FILTER_REQUIRE_ARRAY],
        'zaplata' => ['filter' => FILTER_SANITIZE_SPECIAL_CHARS]
    ];
    $dane = filter_input_array(INPUT_POST, $args);
    $errors = "";
    foreach ($dane as $key => $val) {
        if ($val === false or $val === NULL) {
            $errors .= $key . " ";
        }
    }
    if ($errors === "") {
        $nazwisko = $dane['nazwisko'];
        $wiek = $dane['wiek'];
        $email = $dane['email'];
        $panstwo = $dane['panstwo'];
        $jezyki = implode(",", $dane['jezyki']);
        $zaplata = $dane['zaplata'];
        $sql = "INSERT INTO klienci VALUES (NULL, '$nazwisko', '$wiek', '$panstwo', '$email', '$jezyki', '$zaplata');";
        if(!$bd->insert($sql)) {
            echo "Błąd dodawania do bazy danych";
        }
    } else {
        echo "errors: ", $errors;
    }

}

if (filter_input(INPUT_POST, "submit")) {
    $akcja = filter_input(INPUT_POST, "submit");
    switch ($akcja) {
        case "Dodaj" :
            dodajdoBD($bd);
            break;
        case "Pokaż" :
            echo $bd->select("select * from klienci;", ["Nazwisko", "Zamowienie"]);
            break;
    }
}
?>
</body>
</html>