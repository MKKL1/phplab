<?php namespace lab8;

class RegistrationForm
{
    protected $user;

    public function checkUser()
    {
        $args = [
            'userName' => ['filter' => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '/^[0-9A-Za-ząęłńśćźżó_-]{2,25}$/']],
            'fullName' => ['filter' => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '/^[0-9A-Za-ząęłńśćźżó_-]{2,25} [0-9A-Za-ząęłńśćźżó_-]{2,25}$/']],
            'passwd' => ['filter' => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{5,32}$/']],
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