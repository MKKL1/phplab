<?php

class RegistrationForm
{
    protected $user;

    public function __construct()
    {
        ?>
        <form action="index.php" method="post">
            <fieldset style="width:80%">
                <legend>Formularz</legend>
                <table>
                    <tr>
                        <td>Nazwa użytkownika</td>
                        <td><input type="text" name="userName"/></td>
                    </tr>
                    <tr>
                        <td>Imie i nazwisko</td>
                        <td><input type="text" name="fullName"/></td>
                    </tr>
                    <tr>
                        <td>Hasło</td>
                        <td><input type="password" name="passwd"/></td>
                    </tr>
                    <tr>
                        <td>Podaj email:</td>
                        <td><input type="email" name="email"/>
                        </td>
                    </tr>
                </table>
                <input type="submit" value="Rejestruj"/>
                <input type="reset" value="Anuluj"/>
            </fieldset>
        </form>
        <?php
    }

    public function checkUser()
    {
        $args = [
            'userName' => ['filter' => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '/^[0-9A-Za-ząęłńśćźżó_-]{2,25}$/']],
            'fullName' => ['filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS],
            'passwd' => ['filter' => FILTER_SANITIZE_STRING],
            'email' => ['filter' => FILTER_SANITIZE_EMAIL]
        ];
        $dane = filter_input_array(INPUT_POST, $args);
        if($dane === NULL) {
            return NULL;
        }
        $errors = "";
        foreach ($dane as $key => $val) {
            if ($val === false or $val === NULL) {
                $errors .= $key . " ";
            }
        }
        if ($errors === "") {
            $this->user = new User($dane['userName'], $dane['fullName'], $dane['email'], $dane['passwd']);
        } else {
            $this->user = NULL;
        }
        return $this->user;
    }
}

?>