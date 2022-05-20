<?php

namespace Nhivonfq\Unlock\Database;


use Dotenv\Dotenv;
use PDO;
use PDOException;

class Database
{
    public static \PDO $connection;
    public static function getConnection(): PDO
    {
        var_dump(__DIR__);
        die();
        (new DotEnv(dirname(__DIR__ . "../../.env")))->load();
        if (empty(self::$connection)) {
            $db_info = array(
                "db_dsn" => getenv('DATABASE_DSN'),
                "db_user" => getenv('DATABASE_USER'),
                "db_pass" => getenv('DATABASE_PASSWORD'),
            );

            try {
                self::$connection = new PDO($db_info['db_dsn'], $db_info['db_user'], $db_info['db_pass']);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
                self::$connection->query('SET NAMES utf8');
                self::$connection->query('SET CHARACTER SET utf8');
            } catch (PDOException $error) {
                echo $error->getMessage();
            }
        }

        return self::$connection;
    }
}
