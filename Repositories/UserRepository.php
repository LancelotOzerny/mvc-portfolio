<?php

namespace Repositories;

use Modules\Orm\Entity;
use Modules\Orm\Repository;

class UserRepository extends Repository
{
    function findByEmail(string $email) : Entity | null
    {
        $this->queryBuilder
            ->select(['*'])
            ->from($this->model->getTableName())
            ->where('email = ?', [$email]);

        $stmt = $this->executeQuery($this->queryBuilder);
        $row = $stmt->fetch();

        if (!$row)
        {
            return null;
        }

        foreach ($row as $key => $value)
        {
            $this->model->$key = $value;
        }
        $this->model->id = $row['id'];

        return $this->model;
    }

    function findById(int $id) : Entity | null
    {
        $this->queryBuilder
            ->select(['users.id, email, password_hash, created_at, rights.name as `right_name`, rights.level as `right_level`'])
            ->from($this->model->getTableName())
            ->leftJoin('rights', 'users.rights_id = rights.id')
            ->where('users.id = ?', [$id]);

        $stmt = $this->executeQuery($this->queryBuilder);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

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
}