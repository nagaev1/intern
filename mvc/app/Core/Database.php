<?php

namespace App\Core;

use Exception;
use PDO;

$dotenv = \Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT']);
$dotenv->load();

class Database
{
    private static ?PDO $connection = null;

    public static function connect()
    {
        try {
            switch ($_ENV['DB_CONNECTION']) {
                case "sqlite":
                    self::$connection = new PDO("sqlite:{$_SERVER['DOCUMENT_ROOT']}/db.sqlite");
                    break;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public static function createTable()
    {
        try {
            $pdo = self::getConnection();
            $stmt = $pdo->prepare("CREATE TABLE IF NOT EXISTS posts (  
                id INTEGER PRIMARY KEY AUTOINCREMENT,  
                text TEXT  
            );");
            $stmt->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public static function getConnection(): PDO
    {
        if (self::$connection === null) {
            throw new Exception("Database connection not established");
        }
        return self::$connection;
    }
}
