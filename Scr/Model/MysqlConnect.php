<?php

namespace Scr\Model;

use Scr\Model\SqlConnect;

class MysqlConnect implements SqlConnect
{
    //
    static protected $connect;

    protected function __construct()
    {
    }
    /**
     *  get connection myqsl
     * @return connect
     */
    static public function connection()
    {
        // 
        if (empty(self::$connect)) {
            $cfg = configDb();
            try {
                self::$connect = new \PDO("mysql:host={$cfg['MYSQL_HOST']};dbname={$cfg['MYSQL_DATABASE']};charset={$cfg['MYSQL_CHARSET']}", $cfg['MYSQL_USERNAME'], $cfg['MYSQL_PASSWORD']);
                self::$connect->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_SILENT);
                self::$connect->query('SET NAMES utf8');
                self::$connect->query('SET CHARACTER SET utf8');
            } catch (\PDOException $error) {
                echo $error->getMessage();
            }
        }
        return self::$connect;
    }
}
