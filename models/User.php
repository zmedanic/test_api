<?php

namespace models;

use \components\Connection;

/**
* TMain class for API
 * @property int id
 * @property string token
 * @property string usenname
**/
class User {

    public $id;
    public $username;
    public $token;

    /**
     * find user
    */
    public function find() {}


    /**
     * Save user
    */
    public function save() {}


    /**
     * Find user by token
    */
   public function findUser($token) {
        if (!empty($token)) {
            $connection = new Connection();

            if ($result = $connection->db->query("SELECT * FROM user WHERE token = '" . addslashes($token) . "'")) {
                while($obj = $result->fetch_object()){
                    $this->id = $obj->id;
                }
            }
            $result->close();
        }

        return $this;
    }
}
