<?php

namespace App\Utils;

abstract class Database {
    protected static $pdo;

    protected static function dbConnect() {
        try {
            if (!self::$pdo) {
                self::$pdo = new \PDO("mysql:host=localhost;dbname=blog", 'blog', 'mwWH5NHJVduc8SmT');
                self::$pdo->setAttribute(\PDO::ATTR_ERRMODE , \PDO::ERRMODE_EXCEPTION);
                return self::$pdo;
            }
            return self::$pdo;
        } catch (\PDOException $e) {
            echo "Une erreur est survenue : <br>" . $e->getMessage();
        }
    }
}