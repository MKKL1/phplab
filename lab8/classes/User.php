<?php namespace lab8;

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
        $this->date = new \DateTime();
        $this->userName = $userName;
        $this->fullName = $fullName;
        $this->email = $email;
        $this->passwd = password_hash($passwd, PASSWORD_DEFAULT);
    }

    public function show() {
        echo "$this->userName $this->fullName $this->email status: $this->status " . $this->date->format('Y-m-d H:i:s');
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