<?php

namespace components;

/**
* Connection class
**/
class Connection {

    public $db;
    public $user;

    public function __construct() {
        $dbParams = require __DIR__ . '/../config/db.php';

        if (isset($dbParams['host']) && isset($dbParams['username']) && isset($dbParams['password']) && isset($dbParams['db'])) {
            $this->db = new \mysqli($dbParams['host'], $dbParams['username'], $dbParams['password'], $dbParams['db']);

            return empty($this->db->connect_errno);
        }

        return false;
    }
}
