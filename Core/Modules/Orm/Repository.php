<?php

namespace Modules\Orm;

use Modules\Database\Connection;
use PDO;

class Repository
{
    protected Entity $model;

    public function __construct(Entity $model)
    {
        $this->model = $model;
    }

    public function save() : bool
    {
        return true;
    }

    public function findAll() : array
    {
        $sql = "SELECT * FROM {$this->model->getTableName()}";

        $stmt = Connection::getPdo()->prepare($sql);
        $stmt->execute();

        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $models = [];

        foreach ($rows as $row)
        {
            $model = clone $this->model;

            foreach ($row as $key => $value)
            {
                $model->$key = $value;
            }

            $model->id = (int)$row['id'] ?? null;
            $models[] = $model;
        }

        return $models;
    }

    public function find(int $id): ?Entity
    {
        $sql = "SELECT * FROM {$this->model->getTableName()} WHERE id = ?";
        $stmt = Connection::getPdo()->prepare($sql);
        $stmt->execute([$id]);
        $row = $stmt->fetch();

        if ($row)
        {
            foreach ($row as $key => $value)
            {
                $this->model->$key = $value;
            }

            $this->model->id = (int)$row['id'];
            return $this->model;
        }

        return null;
    }


    public function delete() : bool
    {
        $sql = "DELETE FROM {$this->model->getTableName()} WHERE id = ?";
        $stmp = Connection::getPdo()->prepare($sql);
        return $stmp->execute([$this->model->id]);
    }
}