<?php

namespace citymobile;

use Administrator;
use PDO;

class AdministratorManager extends Manager {
    private $errors = [];
    const ERROR_CONNECT = 'bad_id';

    public static function isConnected() {
        return isset($_SESSION['admin_id']);
    }

    /**
     * Get administrator from DB.
     * @param Administrator $administrator
     * @return Administrator
     */
    private function get(Administrator $administrator): Administrator {
        $q = $this->db->prepare("SELECT * FROM administrator WHERE username = :username");
        $q->bindValue('username', $administrator->getUsername());
        $q->execute();

        unset($administrator);
        $administrator = $q->fetch(PDO::FETCH_ASSOC);
        return new Administrator($administrator);

    }

    /**
     * Check if the administrator exists in the DB
     * @param Administrator $administrator
     * @return bool
     */
    private function checkExist(Administrator $administrator): bool {
        $q = $this->db->prepare("SELECT count(*) FROM administrator WHERE username = :username");
        $q->bindValue('username', $administrator->getUsername());
        $q->execute();
        return $q->fetchColumn()>0;
    }

    /**
     * Check if the password is equal
     * @param Administrator $administrator
     * @param Administrator $realAdministrator
     * @return bool
     */
    private function checkPassword(Administrator $administrator, Administrator $realAdministrator): bool {
       return password_verify($administrator->getPassword(), $realAdministrator->getPassword());
    }

    /**
     * Connecting the administrator and creating the SESSION
     * return $errors -> empty if administrator is connected.
     * or $errors = ERROR_CONNECT if the administrator is not connected
     * @param Administrator $administrator
     * @return array|int
     */
    public function connect(Administrator $administrator) {
        if($this->checkExist($administrator)) {
            $realAdministrator = $this->get($administrator);
            if($this->checkPassword($administrator, $realAdministrator)) {
                unset($administrator);
                $administrator = $realAdministrator;
                $_SESSION['admin_id'] = $administrator->getId();
                $_SESSION['admin_username'] = $administrator->getUsername();
                $_SESSION['admin_mail'] = $administrator->getMail();

            } else { $this->errors = self::ERROR_CONNECT; }

        }else { $this->errors = self::ERROR_CONNECT; };

        return $this->errors;

    }

}