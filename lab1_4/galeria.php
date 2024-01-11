<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>tytul</title>
        <link rel="stylesheet" href="style.php" media="screen">
    </head>
    <body>
        <?php
            function galeria($rows, $cols) {
                $x = 1;
                print("<div class='row'>");
                for ($i = 0; $i < $rows; $i++) {
                    print("<div class='column'>");
                    for ($j = 0; $j < $cols; $j++) {
                        $nazwa = 'obraz' . $x;
                        print("<img src='zdjecia/$nazwa.JPG' alt='$nazwa'/>" );
                        $x += 1;
                    }
                    print("</div>");
                    
                }
                print("</div>");
            }
            galeria(2, 4);
        ?>
    </body>
</html>
