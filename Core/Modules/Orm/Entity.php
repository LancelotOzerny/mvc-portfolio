<?php

namespace Modules\Orm;

class Entity implements \JsonSerializable
{
    protected string $table;
    public ?int $id;
    protected array $fields = [];

    public function getTableName(): string
    {
        return $this->table;
    }

    public function getFields(): array
    {
        return $this->fields;
    }

    public function jsonSerialize(): mixed
    {
        return array_merge(['id' => $this->id], $this->getFields());
    }

    public function save() : bool
    {
        $repo = new Repository($this);
        return $repo->save();
    }

    public function findById(int $id) : ?Entity
    {
        $repo = new Repository($this);
        return $repo->find($id);
    }

    public function delete() : bool
    {
        $repo = new Repository($this);
        return $repo->delete();
    }

    public function __get(string $name)
    {
        return $this->fields[$name] ?? null;
    }

    public function __set(string $name, $value)
    {
        $this->fields[$name] = $value;
    }
}