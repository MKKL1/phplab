<?php

namespace lab8;

class LoggedUserManager
{

    /**
     * @param Baza $db
     * @return mixed
     */
    function login($db) {
        $args = [
            'login' => [FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '/^[0-9A-Za-ząęłńśćźżó_-]{2,25}$/']],
            'passwd' => [FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{5,32}$/']]
        ];

        $dane = filter_input_array(INPUT_POST, $args);
        $login = $dane["login"];
        $passwd = $dane["passwd"];
        $userId = $db->selectUser($login, $passwd, "users");
        if ($userId >= 0) {
            //rozpocznij sesję zalogowanego użytkownika
            session_start();
            //usuń wszystkie wpisy historyczne dla użytkownika o $userId
            $db->query("DELETE FROM logged_in_users WHERE userId='$userId'");
            //ustaw datę - format("Y-m-d H:i:s");
            $date = new \DateTime('now');
            $dateString = $date->format("Y-m-d H:i:s");
            //pobierz id sesji i dodaj wpis do tabeli logged_in_users
            $sql = "INSERT INTO logged_in_users VALUES ('" . session_id() . "', '$userId', '$dateString');";
            try {
                $db->query($sql);
            } catch (\PDOException $e) {
                echo $e->getMessage();
            }
        }
        return $userId;
    }

    function isLoggedIn(Baza $db): bool
    {
        return $this->getLoggedInUser($db, session_id()) >= 0;
    }
    /**
     * @param Baza $db
     */
    function logout(Baza $db): void
    {
        if((session_status() === PHP_SESSION_NONE)) session_start();
        $sessionId = session_id();
        $_SESSION = [];
        setcookie($_COOKIE[session_name()]);
        session_destroy();
        $db->query("DELETE FROM logged_in_users WHERE sessionId='$sessionId'");
    }

    /**
     * @param Baza $db
     * @param string $sessionId
     * @return int
     */
    function getLoggedInUser(Baza $db, string $sessionId): int
    {
        $id = -1;
        $sql = "SELECT * FROM logged_in_users WHERE sessionId='$sessionId'";
        if ($result = $db->query($sql)) {
            $ile = $result->rowCount();
            if ($ile == 1) {
                $row = $result->fetchObject();
                $id = $row->userId;
            }
        }
        return $id;
    }
}