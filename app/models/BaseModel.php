<?php

namespace App\Models;
defined('DIRECT_ACCESS_ALLOWED') or exit('No direct script access allowed');

use App\DB\DbConnection;
use PDO;

class BaseModel
{
    protected PDO $db;

    public function __construct()
    {
        $this->db = DbConnection::getInstance();
    }

}
