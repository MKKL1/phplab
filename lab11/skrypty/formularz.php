<?php
//wykorzystaj lekko zmodyfikowane wcześniej tworzone funkcje
//pomocnicza funkcja generująca formularz:
function drukuj_form() {
    $zawartosc = '<div id="tresc">
<form action="http://localhost/phplab/lab11/skrypty/formularz.php" method="post">
    <fieldset style="width:80%">
        <legend>Formularz</legend>
        <table>
            <tr>
                <td>Podaj nazwisko:</td>
                <td><input type="text" name="nazwisko"/></td>
            </tr>
            <tr>
                <td>Wiek:</td>
                <td><input type="number" name="wiek"></td>
            </tr>
            <tr>
                <td>Podaj email: </td>
                <td><input type="email" name="email" pattern="[a-zA-Z0-9_]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+"/></td>
            </tr>
            <tr>
                <td>Państwo: </td>
                <td><select id="panstwo" name="panstwo">
                        <option>Polska</option>
                        <option>Inny</option>
                    </select></td>
            </tr>
        </table>
        <br /><br />
        Zamawiam tutorial z języka: <br />';

        $jezyki = ["Java", "PHP", "CPP"];
        foreach($jezyki as $v) {
            $zawartosc .= '
        <input type="checkbox" id="lang'. $v . '" name="jezyki[]" value="'. $v . '" />
        <label for="lang'. $v . '">'. $v . '</label>';

        }

        $zawartosc .= '
        <br />

        <br />Sposób zapłaty <br />
        <input type="radio" name="zaplata" value="eurocard" /> eurocard <br />
        <input type="radio" name="zaplata" value="visa" /> visa <br />
        <input type="radio" name="zaplata" value="przelew" /> przelew bankowy<br />
        <br />
        <input type="submit" name="submit" value="Dodaj" />
        <input type="submit" name="submit" value="Pokaż" />
        <input type="reset" name="reset" value="Wyczyść" />
    </fieldset>
</form>
    </div> ';
    return $zawartosc;
}
function walidacja() { //bez zmian
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
    if($errors !== "") {
        die("errors ". $errors);
    }
    return $dane;
}
function dodajdoBD($bd) { //bez zmian
    $dane = walidacja();

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
}

//uchwyt do bazy klienci:
include_once "../classes/Baza.php";
$tytul = "Formularz zamowienia";
echo drukuj_form();
$bd = new Baza("localhost", "root", "", "klienci");
if (filter_input(INPUT_POST, "submit")) {
    $akcja = filter_input(INPUT_POST, "submit");
    switch ($akcja) {
        case "Dodaj" :
            dodajdoBD($bd);
            break;
        case "Pokaż" :
            echo $bd->select("select * from klienci", ["email", "zamowienie"]);
            break;
    }
}