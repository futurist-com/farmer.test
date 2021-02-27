<?php

function configDb()
{
    $cfg['MYSQL_HOST'] = 'mysql';
    $cfg['MYSQL_USERNAME'] = 'root';
    $cfg['MYSQL_PASSWORD'] = 'root';
    $cfg['MYSQL_DATABASE'] = 'farmer';
    $cfg['MYSQL_CHARSET']='utf8mb4';
    return $cfg;
}
