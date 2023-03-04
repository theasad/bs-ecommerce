<?php

namespace db;
defined('DIRECT_ACCESS_ALLOWED') or exit('No direct script access allowed');

use Exception;
use exceptions\InvalidPDOConnection;
use PDO;
use PDOException;

class DbConnection
{
    private static ?DbConnection $instance;
    private PDO $pdo;

    /**
     * @throws InvalidPDOConnection
     * @throws Exception
     */
    private function __construct()
    {
        $dbConfig = config('app.database');
        $dsn = "mysql:host={$dbConfig['host']};port={$dbConfig['port']};dbname={$dbConfig['dbname']};charset=utf8mb4";

        try {
            $this->pdo = new PDO($dsn, $dbConfig['username'], $dbConfig['password']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new InvalidPDOConnection("Failed to connect to database: " . $e->getMessage());
        }
    }

    /**
     * @return PDO
     */
    public static function getInstance(): PDO
    {
        if (empty(self::$instance)) {
            self::$instance = new DbConnection();
        }
        return self::$instance->pdo;
    }
}
