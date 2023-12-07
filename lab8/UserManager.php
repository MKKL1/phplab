<?php

namespace lab8;

class UserManager
{
    function loginForm()
    {
        ?>
        <h3>Formularz logowania</h3><p>
        <form action="processLogin.php" method="post">
            <table>
                <tr>
                    <td>Nazwa użytkownika</td>
                    <td><input type="text" name="login"/></td>
                </tr>
                <tr>
                    <td>Hasło</td>
                    <td><input type="password" name="passwd"/></td>
                </tr>
            </table>
            <input type="submit" value="Zaloguj" name="zaloguj" />
        </form></p> <?php
    }

    /**
     * @param Baza $db
     * @return mixed
     */
    function login($db) {
        $args = [
            'login' => FILTER_SANITIZE_ADD_SLASHES,
            'passwd' => FILTER_SANITIZE_ADD_SLASHES
        ];

        $dane = filter_input_array(INPUT_POST, $args);
        $login = $dane["login"];
        $passwd = $dane["passwd"];
        $userId = $db->selectUser($login, $passwd, "users");
        if ($userId >= 0) {
            //rozpocznij sesję zalogowanego użytkownika
            session_start();
            //usuń wszystkie wpisy historyczne dla użytkownika o $userId
            $db->delete("DELETE FROM logged_in_users WHERE userId='$userId'");
            //ustaw datę - format("Y-m-d H:i:s");
            $date = new \DateTime('now');
            $dateString = $date->format("Y-m-d H:i:s");
            //pobierz id sesji i dodaj wpis do tabeli logged_in_users
            $sql = "INSERT INTO logged_in_users VALUES ('" . session_id() . "', '$userId', '$dateString');";
            $db->insert($sql);
        }
        return $userId;
    }
    /**
     * @param Baza $db
     */
    function logout($db) {
//pobierz id bieżącej sesji (pamiętaj o session_start()
        session_start();
        $sessionId = session_id();
//usuń sesję (łącznie z ciasteczkiem sesyjnym)
        $_SESSION = [];
        setcookie($_COOKIE[session_name()]);
        session_destroy();
//usuń wpis z id bieżącej sesji z tabeli logged_in_users
        $db->delete("DELETE FROM logged_in_users WHERE sessionId='$sessionId'");
    }
    /**
     * @param Baza $db
     * @param string $sessionId
     */
    function getLoggedInUser($db, $sessionId) {
//wynik $userId - znaleziono wpis z id sesji w tabelilogged_in_users
//wynik -1 - nie ma wpisu dla tego id sesji w tabelilogged_in_users
        $id = -1;
        $sql = "SELECT * FROM logged_in_users WHERE sessionId='$sessionId'";
        if ($result = $db->query($sql)) {
            $ile = $result->num_rows;
            if ($ile == 1) {
                $row = $result->fetch_object();
                $id = $row->userId;
            }
        }
        return $id;
    }
}