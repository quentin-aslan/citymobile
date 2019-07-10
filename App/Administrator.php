<?php

class Administrator {

    private $errors = [];
    private $id;
    private $username;
    private $password;
    private $mail;

    const ERROR_USERNAME = 1;
    const ERROR_PASSWORD = 2;
    const ERROR_MAIL = 3;

    public function __construct($datas = [])
    {
        $this->hydrate($datas);
    }

    public function hydrate($datas)
    {
        foreach ($datas as $key => $value) {
            $method = 'set' . ucfirst($key);
            if(method_exists($this, $method))
                $this->$method($value);
        }
    }

    private function checkSetter($value) { return htmlspecialchars($value); }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail): void
    {
        if(!is_string($mail) && empty($mail))
            $this->errors = self::ERROR_MAIL;
        $this->mail = $this->checkSetter($mail);
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }
    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        if(!is_string($password) && empty($password))
            $this->errors = self::ERROR_PASSWORD;
        $this->password = $this->checkSetter($password);
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        if(!is_string($username) && empty($username))
            $this->errors = self::ERROR_USERNAME;
        $this->username = $this->checkSetter($username);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = (int) $id;
    }

}