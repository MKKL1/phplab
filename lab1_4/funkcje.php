<?php
function dodaj() {
    walidacja();

}

function dodajDoPliku($path, $dane) {
    $wp=fopen($path, "a",1);
    $daneDoZapisu = "";
    $c = count($dane);
    $i = 0;
    foreach ($dane as $item) {
        $i++;
        if(is_array($item))
            $daneDoZapisu .= funkcje . phpimplode(",", $item) . ($i === $c ? "" : ";");
        else $daneDoZapisu .= $item . ($i === $c ? "" : ";");
    }
    fwrite($wp, $daneDoZapisu . PHP_EOL);
    fclose($wp);
}

function pokaz($tut=null) {
    $allLanguages = ["C","CPP","Java","C#","HTML","CSS","XML","PHP","Javascript"];
    print('<table class="tab"><thead>
                    <tr>
                        <th rowspan="2">Nazwisko</th>
                        <th rowspan="2">Wiek</th>
                        <th rowspan="2">Mail</th>
                        <th rowspan="2">Panstwo</th>
                        <th rowspan="1" colspan="' . count($allLanguages) . '">Jezyki</th>
                        <th rowspan="2">Sposób zapłaty</th>
                    </tr>
                    <tr>');

    foreach ($allLanguages as $jezyk) {
        print("<th>$jezyk</th>");
    }
    print("</tr></thead><tbody>");
    $wp=fopen("dane.csv", "r",1);
    while(($dataline = fgetcsv($wp, 100, ';')) !== FALSE) {
        $jezykiArray = explode(",", $dataline[4]);
        if($tut == null || in_array($tut ,$jezykiArray)) {
            print("<tr><td>" . $dataline[0] . "</td>");
            print("<td>" . $dataline[1] . "</td>");
            print("<td>" . $dataline[2] . "</td>");
            print("<td>" . $dataline[3] . "</td>");

            foreach (checkLanguages($allLanguages, $jezykiArray) as $value) {
                if ($value)
                    print("<td>X</td>");
                else
                    print("<td> </td>");
            }
            print("<td>" . $dataline[5] . "</td>");
            print("</tr>");
        }
    }
    print("</tbody></table>");
    fclose($wp);
}

function checkLanguages($allLanguages, $someLanguages) {
    $result = array();
    foreach ($allLanguages as $language) {
        $result[] = in_array($language, $someLanguages);
    }
    return $result;
}

function walidacja() {
    $args = [
        'nazwisko' => ['filter' => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '/^[A-Z]{1}[a-ząęłńśćźżó-]{1,25}$/']],
        'wiek' => ['filter' => [FILTER_VALIDATE_INT, FILTER_SANITIZE_FULL_SPECIAL_CHARS]],
        'email' => ['filter' => [FILTER_VALIDATE_EMAIL, FILTER_SANITIZE_FULL_SPECIAL_CHARS]],
        'panstwo' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'jezyki' => ['filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'flags' => FILTER_REQUIRE_ARRAY],
        'zaplata' => ['filter' => FILTER_SANITIZE_SPECIAL_CHARS]
    ];
    $dane = filter_input_array(INPUT_POST, $args);
    var_dump($dane);
    $errors = "";
    foreach ($dane as $key => $val) {
        if ($val === false or $val === NULL) {
            $errors .= $key . " ";
        }
    }
    if ($errors === "") {
        dodajDoPliku("dane.csv", $dane);
    } else {
        echo "<br>Nie poprawnie dane: $errors</br>";
    }
}

function statystyki() {
    $count = 0;
    $mniejniz18 = 0;
    $wiecejniz50 = 0;
    $wp=fopen("dane.csv", "r",1);
    while(($dataline = fgetcsv($wp, 100, ';')) !== FALSE) {
        $wiek = $dataline[1];
        if($wiek < 18) $mniejniz18++;
        else if ($wiek >= 50) $wiecejniz50++;
        $count++;
    }
    echo "<br>Liczba wszystkich zamówień: $count</br>";
    echo "<br>Liczba zamówienień od osób w wieku < 18 lat: $mniejniz18</br>";
    echo "<br>Liczba zamówienień od osób w wieku >= 50 lat: $wiecejniz50</br>";

}
?>