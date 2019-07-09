<?php

namespace citymobile;

use PDO;

class Manager {

    protected $db;
    private $host = '127.0.0.1';
    private $dbName = 'citymobilepoo';
    private $username = 'root';
    private $password = '';

    public function __construct() {
        $this->db = new PDO('mysql:host='.$this->host.';dbname='.$this->dbName, $this->username, $this->password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }

}