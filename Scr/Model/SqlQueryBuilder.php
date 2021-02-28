<?php

namespace Scr\Model;

interface SqlQueryBuilder
{
    public function select(array $fields): SqlQueryBuilder;
    public function where(string $field, string $value, string $operator): SqlQueryBuilder;
    public function leftJoin(string $table, string $fieldTableJoin, string $fieldTable): SqlQueryBuilder;
    public function limit(int $start, int $offset): SqlQueryBuilder;
    public function getSQL(): string;
    public function get():array;
    public function update();
    public function insert():array;
    public function firstId(int $id):array;
}
