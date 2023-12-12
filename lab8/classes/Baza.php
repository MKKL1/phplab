<?php namespace lab8;
class Baza
{
    private $dbh;
    private static ?Baza $instance = null;
    private function __construct($server, $user, $pass)
    {
        try {
            $this->dbh = new \PDO($server, $user, $pass, [\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);
        } catch (\PDOException $e) {
            echo "Połączenie z bazą nie mogło zostać utworzone: " . $e->getMessage();
            die();
        }
    }

    public static function getInstance($server, $user, $pass): Baza
    {
        if(self::$instance == null) {
            self::$instance = new Baza($server, $user, $pass);
        }
        return self::$instance;
    }

    function __destruct() {
        $this->dbh = null;
    }

    public function selectUser($login, $password, $tabela) {
        $id = -1;
        $sql = "SELECT * FROM $tabela WHERE userName='$login'";
        if ($result = $this->dbh->query($sql)) {
            $ile = $result->rowCount();
            if ($ile == 1) {
                $row = $result->fetchObject();
                $hash = $row->passwd;
                if (password_verify($password, $hash))
                    $id = $row->id;
                }
        }
        return $id;
    }

    public function query($sql): false|\PDOStatement
    {
        return $this->dbh->query($sql);
    }
}