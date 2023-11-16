
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<div id="content">
    <main>
        <p>Wyniki ankiety</p></br>
        <?php
        //Po otrzymaniu odpowiedzi, program pierwsze wczytuje dane z pliku do tablicy asocjacyjnej,
        // inkrementuje odpowiednie wartości, wyświetla je na stronie po czym zapisuje je do pliku.
        // Jest tutaj możliwa optymalizacja poprzez otwarcie pliku tylko raz do zapisu i odczytu.
        // W pliku nie są zapisywane wartości 0.
        $ankieta_path = "wynikiAnkiety.txt";

        if (filter_input(INPUT_POST, "submit")) {
            $akcja = filter_input(INPUT_POST, "submit");
            switch ($akcja) {
                case "Wyslij":
                    walidacjaWynikow();
                    break;
            }
        }

        function walidacjaWynikow() {
            $args = ['jezyki' => ['filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'flags' => FILTER_REQUIRE_ARRAY]];
            $dane = filter_input_array(INPUT_POST, $args);
            $errors = "";
            foreach ($dane as $key => $val) {
                if ($val === false or $val === NULL) {
                    $errors .= $key . " ";
                }
            }
            if ($errors === "") {
                $daneAnkiety = wczytajDaneAnkiety();
                foreach ($dane['jezyki'] as $item) {
                    if(array_key_exists($item, $daneAnkiety))
                        $daneAnkiety[$item]++;
                    else $daneAnkiety[$item] = 1;
                }
                wyswietlDaneAnkiety($daneAnkiety);
                zapiszDaneAnkiety($daneAnkiety);

            } else {
                echo "<br>Nie poprawnie dane: $errors</br>";
            }
        }

        function wyswietlDaneAnkiety($daneAnkiety) {
            foreach ($daneAnkiety as $jezyk=>$ilosc) {
                echo "$jezyk: $ilosc</br>";
            }
        }

        function wczytajDaneAnkiety() {
            global $ankieta_path;
            $daneAnkiety = [];
            if(!file_exists($ankieta_path)) {
                //Stwórz plik jeżeli nie istnieje
                $wp = fopen($ankieta_path, "w", 1);
            } else {
                $wp = fopen($ankieta_path, "r+", 1);
                while (($dataline = fgets($wp)) !== FALSE) {
                    $p = explode(":", $dataline);
                    if(count($p) != 2) {
                        continue;
                    }
                    $jezyk = $p[0];
                    $ilosc = (int)$p[1];
                    $daneAnkiety[$jezyk] = $ilosc;
                }
            }
            fclose($wp);
            return $daneAnkiety;
        }

        function zapiszDaneAnkiety($daneAnkiety) {
            global $ankieta_path;
            $wp=fopen($ankieta_path, "w",1);
            foreach ($daneAnkiety as $jezyk => $ilosc) {
                fwrite($wp, $jezyk . ':' . $ilosc . PHP_EOL);
            }
            fclose($wp);
        }
        ?>

    </main>
</div>

</body>
</html>