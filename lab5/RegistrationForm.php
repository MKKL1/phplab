<?php
    class RegistrationForm {
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
                        <td><input type="text" name="userName" pattern="[a-zA-Z0-9_-]{3,15}"/></td>
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
                        <td>Podaj email: </td>
                        <td><input type="email" name="email" pattern="[a-zA-Z0-9_]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+"/></td>
                    </tr>
                </table>
                <input type="submit" value="Rejestruj" />
                <input type="reset" value="Anuluj" />
            </fieldset>
        </form>
        <?php
        }
        public function checkUser() {
            $args = [
                'userName' => ['filter' => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '/^[0-9A-Za-ząęłńśćźżó_-]{2,25}$/']],
                'fullName' => ['filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS],
                'passwd' => ['filter' => FILTER_SANITIZE_STRING],
                'email' => ['filter' => FILTER_SANITIZE_EMAIL]
            ];
            $dane = filter_input_array(INPUT_POST, $args);
        }
    }
?>