<?php
namespace app\models;
use app\engine\Db;
use app\interfaces\IModel;
use app\models\Repositories\BasketProductRepository;

abstract class Repository
{
    abstract protected function getTableName();
    abstract protected function getEntityClass();

    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return DB::getInstance()->queryOneObject($sql, ['id' => $id], $this->getEntityClass());
    }

    public function getOneWhereObject($key, $value)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE {$key} = :value";
        return DB::getInstance()->queryOneObject($sql, ['value' => $value],  $this->getEntityClass());
    }
    public function getLimit($limit_from, $limit)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} LIMIT ?, ?";
        return DB::getInstance()->queryLimit($sql, $limit_from, $limit);
    }
    public function getCountWhere($name, $value) {
        $tableName = $this->getTableName();
        $sql = "SELECT count(id) as count FROM {$tableName} WHERE `{$name}`=:value";
        return Db::getInstance()->queryOne($sql, ['value' => $value])['count'];
    }

    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";

        return DB::getInstance()->queryAll($sql);
    }

    protected function insert(Model $entity)
    {

        $params = [];
        $columns = [];


        foreach ($entity->props as $key => $value) {
            $params[":{$key}"] = $entity->$key;
            $columns[] = $key;

        }
        $tableName = $this->getTableName();
        $values = implode(', ', array_keys($params));
        $columns = implode(', ', $columns);
        $sql = "INSERT INTO {$tableName} ({$columns}) VALUES ({$values})";
        DB::getInstance()->execute($sql, $params);
        $entity->id = DB::getInstance()->lastInsertId();
        return $this;
    }

    public function delete(Model $entity)
    {

        $tableName = $this->getTableName();
        $sql = "DELETE from {$tableName} where id = :id";
        $params[':id'] = $entity->id;
        return DB::getInstance()->queryOne($sql, $params);
    }

    protected function update(Model $entity)
    {
        $params = [];
        $columns = [];
        foreach ($entity->props as $key => $value) {
            if (!$value) continue;
            $params["{$key}"] = $entity->$key;
            $columns[] .= "`{$key}` = :{$key}";
            $entity->props[$key] = false;
        }
        $columns = implode(", ", $columns);
        $tableName = $this->getTableName();
        $params['id'] = $entity->id;
        $sql = "UPDATE `{$tableName}` SET {$columns} WHERE `id` = :id";
        return Db::getInstance()->execute($sql, $params);
    }

    public function save(Model $entity)
    {
        if (is_null($entity->id)) {
            return $this->insert($entity);
        } else {
            return $this->update($entity);
        }
    }

}