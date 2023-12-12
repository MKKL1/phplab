<?php namespace lab8;

class UserManager
{
    private Baza $baza;
    public function __construct(Baza $baza)
    {
        $this->baza = $baza;
    }

    function add(User $user)
    {
        $formattedDate = $user->getDate()->format('Y-m-d H:i:s');
        $username = $user->getUserName();
        $fullName = $user->getFullName();
        $email = $user->getEmail();
        $passwd = $user->getPasswd();
        $status = $user->getStatus();
        $sql = "INSERT INTO users VALUES (NULL, '$username', '$fullName', '$email', '$passwd', '$status', '$formattedDate');";
        try {
            $this->baza->query($sql);
        } catch (\PDOException $e) {
            return false;
        }
        return true;
    }

}