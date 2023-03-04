<?php

namespace db;
defined('DIRECT_ACCESS_ALLOWED') or exit('No direct script access allowed');

use Exception;
use exceptions\InvalidPDOConnection;
use PDO;

class DbConnection
{
    public PDO $db;

    /**
     * @throws InvalidPDOConnection
     * @throws Exception
     */
    public function __construct()
    {
        $db_config = config('app.database');
        $dsn = "mysql:host={$db_config['host']};port={$db_config['port']};dbname={$db_config['dbname']};charset=utf8mb4";
        try {
            $this->db = new PDO($dsn, $db_config['username'], $db_config['password']);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\Throwable $exception) {
            throw new InvalidPDOConnection(message: $exception->getMessage(), code: $exception->getCode());
        }
    }
}
