<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        .tab {
            background: #ffffff;
            color: #000000;
            text-align:center;
            width:94%;
            margin:2%;
        }

        .tab tfoot p{
            margin: 0;
            padding: 0;
        }
        .tab td, th {
            border:1pt solid #2a2a2a;
        }

        .tab tbody tr:nth-child(even) {
            background: #e0e0e0;
        }

        .tab tfoot, thead {
            background:#00d99b;
            color: #1c1c1c;
            font-size:120%
        }
    </style>
</head>
<body>
<div id="content">
    <main>
    <div>
        <form action="pliki.php" method="post">
            <fieldset style="width:80%">
                <legend>Formularz</legend>
                <table>
                    <tr>
                        <td>Podaj nazwisko:</td>
                        <td><input type="text" name="nazwisko" pattern="[a-zA-Z0-9_-]{3,15}"/></td>
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
                Zamawiam tutorial z języka: <br />
                <?php
                $jezyki = ["C","CPP","Java","C#","HTML","CSS","XML","PHP","Javascript"];
                foreach($jezyki as &$v) {
                    print('
                <input type="checkbox" id="lang'. $v . '" name="jezyki[]" value="'. $v . '" />
                <label for="lang'. $v . '">'. $v . '</label>');

                }
                ?>
                <br />

                <br />Sposób zapłaty <br />
                <input type="radio" name="zaplata" value="eurocard" /> eurocard <br />
                <input type="radio" name="zaplata" value="visa" /> visa <br />
                <input type="radio" name="zaplata" value="przelew" /> przelew bankowy<br />
                <br />
                <input type="reset" value="Wyczyść" />
                <input type="submit" name="submit" value="Zapisz" />
                <input type="submit" name="submit" value="Pokaż" />
                <input type="submit" name="submit" value="PHP" />
                <input type="submit" name="submit" value="CPP" />
                <input type="submit" name="submit" value="Java" />
            </fieldset>
        </form>
    </div>
        <?php
        function dodaj() {
            $dane = "";
            dodaj_jeden($dane, "nazwisko", ";");
            dodaj_jeden($dane, "wiek", ";");
            dodaj_jeden($dane, "email", ";");
            dodaj_jeden($dane, "panstwo", ";");
            $dane .= htmlspecialchars(join(",",$_REQUEST["jezyki"])) . ";";
            dodaj_jeden($dane, "zaplata", "");
            $wp=fopen("plik.csv", "a",1);
            fwrite($wp, $dane."\n");
            fclose($wp);
        }

        function dodaj_jeden(&$dane, $nazwa, $end) {
            if(isset($_REQUEST[$nazwa])) {
                $dane .= htmlspecialchars($_REQUEST[$nazwa]).$end;
            }
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
            $wp=fopen("plik.csv", "r",1);
            while(($dataline = fgetcsv($wp, 100, ';')) !== FALSE) {
                $jezykiArray = explode(",", htmlspecialchars($dataline[4]));
                if($tut == null || in_array($tut ,$jezykiArray)) {
                    print("<tr><td>" . htmlspecialchars($dataline[0]) . "</td>");
                    print("<td>" . htmlspecialchars($dataline[1]) . "</td>");
                    print("<td>" . htmlspecialchars($dataline[2]) . "</td>");
                    print("<td>" . htmlspecialchars($dataline[3]) . "</td>");

                    foreach (checkLanguages($allLanguages, $jezykiArray) as $value) {
                        if ($value)
                            print("<td>X</td>");
                        else
                            print("<td> </td>");
                    }
                    print("<td>" . htmlspecialchars($dataline[5]) . "</td>");
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

        if(isset($_REQUEST["submit"])) {
            $akcja = $_REQUEST["submit"];
            switch ($akcja) {
                case "Zapisz": dodaj();break;
                case "Pokaż": pokaz();break;
                case "PHP": pokaz("PHP");break;
                case "CPP": pokaz("CPP");break;
                case "Java": pokaz("Java");break;
            }
        }
        ?>
    </main>
</div>

</body>
</html>