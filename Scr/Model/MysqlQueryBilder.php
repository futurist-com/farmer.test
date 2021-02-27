<?php

namespace Scr\Model;

use Scr\Model\SqlQueryBuilder;
use Scr\Model\MysqlConnect;

abstract class MysqlQueryBilder implements SqlQueryBuilder
{
    protected $dbh;
    protected $query;
    protected $table;
    private $fields;
    public $values;
    public $datas;

    public function __construct()
    {
        $this->dbh = MysqlConnect::connection();
        $this->init();
    }

    public function __set($name, $value)
    {
        if (array_key_exists($name, $this->fields)) {
            $this->fields[$name] = $value;
        }
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->fields)) {
            return $this->fields[$name];
        }
    }

    protected function reset(): void
    {
        $this->query = new \stdClass();
    }

    protected function init()
    {
        $q = $this->dbh->prepare("DESCRIBE $this->table");
        $q->execute();
        $table_fields = $q->fetchAll(\PDO::FETCH_COLUMN);
        foreach ($table_fields as $fields) {
            $this->fields[$fields] = null;
        }
    }

    public function select(array $fields = array()): MysqlQueryBilder
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

    public function where(string $field, string $value, string $operator = '='): MysqlQueryBilder
    {
        if (!in_array($this->query->type, ['select', 'update', 'delete'])) {
            throw new \Exception("WHERE can only be added to SELECT, UPDATE OR DELETE");
        }
        $this->query->where[] = "$field $operator '$value'";

        return $this;
    }

    public function leftJoin(string $table, string $fieldTableJoin, string $fieldTable): MysqlQueryBilder
    {
        if (!in_array($this->query->type, ['select'])) {
            throw new \Exception("WHERE can only be added to SELECT");
        }
        $this->query->leftJoin[] = "left join  $table on  $fieldTableJoin= $fieldTable";

        return $this;
    }

    public function limit(int $offset, int $start = null): MysqlQueryBilder
    {
        if (!in_array($this->query->type, ['select'])) {
            throw new \Exception("LIMIT can only be added to SELECT");
        }
        if ($start) {
            $this->query->limit = " LIMIT " . $start . ", " . $offset;
        } else {
            $this->query->limit = " LIMIT " . $offset;
        }
        return $this;
    }

    public function getSQL(): string
    {
        $query = $this->query;
        $sql = $query->base;

        if (!empty($query->leftJoin)) {
            foreach ($query->leftJoin as $join)
                $sql .= " $query->where ";
        }
        if (($this->query->type == "insert") or ($this->query->type == "update")) {
            //
            $sql .= $this->pdoSet();
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
        $sth = $this->dbh->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
        return $sth;
    }

    public function  firstId($id)
    {
        $this->select();
        $this->where('id', $id, '=');
        $this->limit(1);
        $sql = $this->getSql();
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
        $result = $sth->fetch(\PDO::FETCH_ASSOC);
        foreach ($result as $key => $val) {
            $this->__set($key, $val);
        }
        return $result;
    }

    public function insert()
    {
        $this->reset();
        $this->query->base = "INSERT INTO $this->table SET ";
        $this->query->type = 'insert';
        $id = $this->save();
        $data=$this->firstId($id);
        return $data;
    }

    public function update()
    {
        $this->reset();
        $this->query->base = "UPDATE $this->table SET ";
        $this->query->type = 'update';
        $this->where('id', $this->id, '=');
        $id=$this->save();
        return $id;
    }

    public function save()
    {
        $sql = $this->getSql();
        $stm = $this->dbh->prepare($sql);
        $stm->execute($this->values);
        return $this->dbh->lastInsertId();
    }

    /**
     * 
     */
    public function pdoSet()
    {
        $set = '';
        $values = array();
        foreach ($this->fields as  $field => $val) {
            if($val){
            $set .= "`" . str_replace("`", "``", $field) . "`" . "=:$field, ";
            $this->values[$field] = $val;
            }
        }
        return  substr($set, 0, -2);
    }
}
