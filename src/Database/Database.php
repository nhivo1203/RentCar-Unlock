<?php

namespace Nhivonfq\Unlock\Database;


use PDO;
use PDOException;

class Database
{
    private static $connection;

    public static function getConnection(array $config): PDO
    {
        if (!self::$connection) {
            $server = $config['server'];
            $dbname = $config['name'];
            $port = $config['port'];
            $username = $config['user'];
            $password = $config['password'];
            try {
                self::$connection = new PDO("mysql:host=$server;port=$port;dbname=$dbname", $username, $password);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }
        return self::$connection;
    }

    public static function prepare($sql) {
        return self::$connection->prepare($sql);
    }
}
