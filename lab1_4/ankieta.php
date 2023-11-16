<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<div id="content">
    <main>
        <div>
            <form action="wyniki.php" method="post">
                Wybierz technologie, które znasz<br/>
                <?php
                $jezyki = ["C", "CPP", "Java", "C#", "HTML", "CSS", "XML", "PHP", "Javascript"];
                foreach ($jezyki as $v) {
                    print('
                        <input type="checkbox" id="lang' . $v . '" name="jezyki[]" value="' . $v . '" />
                        <label for="lang' . $v . '">' . $v . '</label>
                        </br>
                        ');

                }
                ?>

                <input type="submit" name="submit" value="Wyslij"/>
            </form>
        </div>

    </main>
</div>

</body>
</html>