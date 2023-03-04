<?php

namespace models;
defined('DIRECT_ACCESS_ALLOWED') or exit('No direct script access allowed');

use db\DbConnection;

class BaseModel
{
    protected \PDO $db;

    public function __construct()
    {
        $this->db = DbConnection::getInstance();
    }

}
