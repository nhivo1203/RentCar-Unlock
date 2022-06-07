<?php

namespace Nhivonfq\Unlock\Database;


use PDO;
use PDOException;

class Database
{
    private static $connection;


    public static function getConnection(): PDO
    {
        $config = [
            'server' => $_ENV['DB_SERVER'],
            'port' => $_ENV['DB_PORT'],
            'name' => $_ENV['DB_NAME'],
            'user' => $_ENV['DB_USER'],
            'password' => $_ENV['DB_PASSWORD'],
        ];

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
}
