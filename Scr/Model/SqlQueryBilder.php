<?php
namespace Scr\Model;

interface SqlQueryBilder{
    public function select(array $fields):SqlQueryBilder;
    public function where(string $field, string $value, string $operator):SqlQueryBilder;
    public function leftJoin(string $table, string $fieldTableJoin, string $fieldTable ):SqlQueryBilder;
    public function update(array $datas):SqlQueryBilder;
    public function insert(array $datas):SqlQueryBilder;
    public function getSQL();
}