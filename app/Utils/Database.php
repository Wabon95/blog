<?php

namespace App\Utils;

abstract class Database {
    private static $pdo;

    protected static function dbConnect() {
        if (self::$pdo) {
            return self::$pdo;
        } else {
            self::$pdo = new \PDO("mysql:host=localhost;dbname=blog", 'root', '');
            self::$pdo->setAttribute(\PDO::ATTR_ERRMODE , \PDO::ERRMODE_WARNING);
            return self::$pdo;
        }
    }
}