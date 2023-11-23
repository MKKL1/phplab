<?php

class User
{
    const STATUS_USER = 1;
    const STATUS_ADMIN = 2;
    /**
     * @var string
     */
    protected $userName;
    /**
     * @var DateTime
     */
    protected $date;
    /**
     * @var int
     */
    protected $status;
    /**
     * @var string
     */
    protected $email;
    /**
     * @var string
     */
    protected $fullName;
    /**
     * @var string
     */
    protected $passwd;

    public function __construct($userName, $fullName, $email, $passwd)
    {
        $this->status = User::STATUS_USER;
        $this->date = new DateTime();
        $this->userName = $userName;
        $this->fullName = $fullName;
        $this->email = $email;
        $this->passwd = password_hash($passwd, PASSWORD_DEFAULT);
    }

    public function show() {
        echo "$this->userName $this->fullName $this->email status: $this->status " . $this->date->format('Y-m-d H:i:s');
    }

    private static $filename = "users.json";
    private static $filenameXML = "users.xml";
    public static function getAllUsers() {
        $contents = file_get_contents(User::$filename);
        $userArr = json_decode($contents);
        foreach ($userArr as $val) {
            echo "<p>" . $val->userName . " " . $val->fullName . " " . $val->date . "</p>";
        }
    }

    public static function getAllUsersFromXML(){
        $users = simplexml_load_file(User::$filenameXML);
        echo "<ul>";
        foreach ($users as $user){
            $userName = $user->userName;
            $fullName = $user->fullName;
            $email = $user->email;
            $password = $user->passwd;
            $date = $user->date;
            $status = $user->status;
            echo "<li> $userName $fullName $email $password $date $status </li>";
        }
        echo "</ul>";
    }

    function toArray(){
        return [
            "userName" => $this->userName,
            "fullName" => $this->fullName,
            "passwd" => $this->passwd,
            "email" => $this->email,
            "date" => $this->date->format('Y-m-d H:i:s'),
            "status" => $this->status
        ];
    }

    function save(){
        $tab = json_decode(file_get_contents(User::$filename),true);
        array_push($tab,$this->toArray());
        file_put_contents(User::$filename, json_encode($tab));
    }
    public function saveXML() {
        $xml = simplexml_load_file(User::$filenameXML);
        $xmlChild = $xml->addChild("user");
        $xmlChild->addChild("userName", $this->getUserName());
        $xmlChild->addChild("fullName", $this->getFullName());
        $xmlChild->addChild("email", $this->getEmail());
        $xmlChild->addChild("passwd", $this->getPasswd());
        $xmlChild->addChild("date", $this->getDate());
        $xmlChild->addChild("status", $this->getStatus());
        $xml->asXML(User::$filenameXML);
    }
    /**
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @param mixed $fullName
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }

    /**
     * @return string
     */
    public function getPasswd()
    {
        return $this->passwd;
    }

    /**
     * @param string $passwd
     */
    public function setPasswd($passwd)
    {
        $this->passwd = $passwd;
    }


}

?>