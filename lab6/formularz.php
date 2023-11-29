
<form action="index.php" method="post">
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
        <input type="submit" name='submit' value="Dodaj" />
        <input type="submit" name='submit' value="Pokaż" />
        <input type="reset" name='reset' value="Wyczyść" />
    </fieldset>
</form>