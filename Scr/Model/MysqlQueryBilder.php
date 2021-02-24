<?php

namespace Scr\Model;

use Scr\Model\SqlQueryBilder;

abstract class MysqlQueryBilder implements SqlQueryBilder
{
    protected $dbh;
    protected $query;
    protected $table;

    function __construct()
    {
        $cfg = configDb();
        $this->dbh = new \PDO("mysql:host={$cfg['MYSQL_HOST']};dbname={$cfg['MYSQL_DATABASE']};charset=utf8mb4", $cfg['MYSQL_USERNAME'], $cfg['MYSQL_PASSWORD']);
    }

    protected function reset(): void
    {
        $this->query = new \stdClass();
    }

    public function select(array $fields) : MysqlQueryBilder
    {
        $this->reset();
        if (empty($fields)) {
            $this->query->base = "SELECT * FROM " . $this->table;
        } else {
            $this->query->base = "SELECT " . implode(", ", $fields) . " FROM " . $this->table;
        }
        $this->query->type = 'select';
        return $this;
    }

    public function where(string $field, string $value, string $operator = '=') : MysqlQueryBilder
    {
        if (!in_array($this->query->type, ['select', 'update', 'delete'])) {
            throw new \Exception("WHERE can only be added to SELECT, UPDATE OR DELETE");
        }
        $this->query->where[] = "$field $operator '$value'";

        return $this;
    }

    public function leftJoin(string $table, string $fieldTableJoin, string $fieldTable) : MysqlQueryBilder
    {
        if (!in_array($this->query->type, ['select'])) {
            throw new \Exception("WHERE can only be added to SELECT");
        }
        $this->query->leftJoin[] = "left join  $table on  $fieldTableJoin= $fieldTable";

        return $this;
    }
    
    public function getSQL() //: string
    {
        $query = $this->query;
        $sql = $query->base;

        if (!empty($query->leftJoin)) {
            foreach ($query->leftJoin as $join)
                $sql .= " $query->where ";
        }
        if (($this->query->type == "insert") or ($this->query->type == "update")) {
        //
            $sql .= $this->pdoSet($this->datas);
        }
        if (!empty($query->where)) {
            $sql .= " WHERE " . implode(' AND ', $query->where);
        }
        if (isset($query->limit)) {
            $sql .= $query->limit;
        }
        $sql .= ";";
        return $sql;
    }
    public function get()
    {
        $sql = $this->getSql();
        $sth = $this->dbh->query($sql)->fetchAll(\PDO::FETCH_UNIQUE);
        return $sth;
    }

    public function insert(array $datas): MysqlQueryBilder
    {
        $this->reset();
        $this->datas=$datas;
        $this->query->base = "INSERT INTO $this->table SET ";
        $this->query->type = 'insert';
    
        return $this;
    }

    public function update($datas): MysqlQueryBilder
    {
        //
        $this->reset();
        $this->query->base = "UPDATE $this->table SET ";
        $this->datas=$datas;
        $this->query->type = 'update';
        return $this;
    }

    public function save()
    {
        $sql = $this->getsql();
        $stm = $this->dbh->prepare($sql);
        $stm->execute($this->values);
        return $this->dbh->lastInsertId ();
    }

    public function pdoSet($datas)
    {
        $set = '';
        $values = array();
        foreach ($datas as  $field => $val) {
            $set .= "`" . str_replace("`", "``", $field) . "`" . "=:$field, ";
            $this->values[$field] = $val;
        }
        return  substr($set, 0, -2) ;
    }
}
