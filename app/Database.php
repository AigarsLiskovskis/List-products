<?php

namespace App;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception;

class Database
{
    private static $connection = null;

    /**
     * @throws Exception
     */
    public static function connection(): Connection
    {
        if (self::$connection === null) {
            $connectionParams = [
                'dbname' => 'product_list',
                'user' => 'root',
                'password' => 'codelex123',
                'host' => 'localhost',
                'driver' => 'pdo_mysql',
            ];
            self::$connection = DriverManager::getConnection($connectionParams);
        }
        return self::$connection;
    }
}
