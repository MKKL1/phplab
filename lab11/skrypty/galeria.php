<?php
echo "<h1>O nas</h1>";
$zawartosc = "";
function galeria($rows, $cols) {
    $x = 1;
    $zawartosc = "<div class='row'>";
    for ($i = 0; $i < $rows; $i++) {
        $zawartosc .= "<div class='column'>";
        for ($j = 0; $j < $cols; $j++) {
            $nazwa = 'obraz' . $x;
            $zawartosc .= "<img src='zdjecia/$nazwa.JPG' alt='$nazwa'/>";
            $x += 1;
        }
        $zawartosc .= "</div>";

    }
    $zawartosc .= "</div>";
    return $zawartosc;
}
$zawartosc .= galeria(2, 4);

echo $zawartosc;