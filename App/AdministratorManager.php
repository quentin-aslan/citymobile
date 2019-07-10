<?php

namespace citymobile;

use Administrator;
use PDO;

class AdministratorManager extends Manager {

    const CONNECT = 1;
    const ERROR_CONNECT = 2;

    /**
     * Get administrator from DB.
     * @param Administrator $administrator
     * @return Administrator
     */
    public function get(Administrator $administrator): Administrator {
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
     * @param Administrator $administrator
     * @return int
     */
    public function connect(Administrator $administrator) {
        if($this->checkExist($administrator)) {
            $realAdministrator = $this->get($administrator);
            if($this->checkPassword($administrator, $realAdministrator)) {
                unset($administrator);
                $administrator = $realAdministrator;
                $_SESSION['administratorId'] = $administrator->getId();
                $_SESSION['administratorUsername'] = $administrator->getUsername();
                $_SESSION['administratorMail'] = $administrator->getMail();

                $return = self::CONNECT;
            } else { $return = self::ERROR_CONNECT; }

        }else { $return = self::ERROR_CONNECT; };

        return $return;

    }

}