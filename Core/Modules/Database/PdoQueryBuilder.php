<?php

namespace Modules\Database;

class PdoQueryBuilder implements IQueryBuilder
{
    private string $sql = '';
    private array $params = [];
    private bool $hasWhere = false;
    private bool $hasGroupBy = false;


    public function select(array $columns): self
    {
        $cols = empty($columns) ? '*' : implode(', ', $columns);
        $this->sql = "SELECT $cols";
        return $this;
    }

    public function from(string $table): self
    {
        $this->sql .= " FROM $table";
        return $this;
    }

    public function where(string $condition, array $params = []): self
    {
        $this->sql .= " WHERE $condition";
        $this->params = array_merge($this->params, $params);
        $this->hasWhere = true;
        return $this;
    }

    public function andWhere(string $condition, array $params = []): self
    {
        if (!$this->hasWhere) {
            return $this->where($condition, $params);
        }
        $this->sql .= " AND $condition";
        $this->params = array_merge($this->params, $params);
        return $this;
    }

    public function orWhere(string $condition, array $params = []): self
    {
        if (!$this->hasWhere) {
            return $this->where($condition, $params);
        }
        $this->sql .= " OR $condition";
        $this->params = array_merge($this->params, $params);
        return $this;
    }

    public function limit(int $limit): self
    {
        $this->sql .= " LIMIT $limit";
        return $this;
    }

    public function offset(int $offset): self
    {
        $this->sql .= " OFFSET $offset";
        return $this;
    }

    /**
     * Формирует запрос INSERT INTO
     * @param string $table Имя таблицы
     * @param array $columns Массив имён колонок (например, ['name', 'email'])
     * @return self
     */
    public function insert(string $table, array $columns): self
    {
        $colList = implode(', ', $columns);
        $placeholders = implode(', ', array_fill(0, count($columns), '?'));

        $this->sql = "INSERT INTO $table ($colList) VALUES ($placeholders)";
        return $this;
    }

    public function delete($table) : self
    {
        $this->sql = " DELETE";
        return $this;
    }

    public function set(array $data): self
    {
        $setParts = [];
        foreach ($data as $column => $value) {
            $setParts[] = "$column = ?";
            $this->params[] = $value;
        }

        $setClause = implode(', ', $setParts);
        $this->sql .= " SET $setClause";

        return $this;
    }

    /**
     * Формирует запрос UPDATE
     * @param string $table Имя таблицы
     * @return self
     */
    public function update(string $table): self
    {
        $this->sql = "UPDATE $table";
        return $this;
    }

    /**
     * Добавляет значения для INSERT (должен вызываться после insert())
     * @param array $values Массив значений в порядке, соответствующем колонкам
     * @return self
     */
    public function values(array $values): self
    {
        $this->params = array_merge($this->params, $values);
        return $this;
    }

    public function getSql(): string
    {
        return $this->sql;
    }

    public function clearParams() : self
    {
        $this->params = [];
        return $this;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * Добавляет INNER JOIN
     * @param string $table Имя присоединяемой таблицы
     * @param string $condition Условие соединения (например, 'users.id = orders.user_id')
     * @return self
     */
    public function innerJoin(string $table, string $condition): self
    {
        $this->sql .= " INNER JOIN $table ON $condition";
        return $this;
    }

    /**
     * Добавляет LEFT JOIN
     * @param string $table Имя присоединяемой таблицы
     * @param string $condition Условие соединения
     * @return self
     */
    public function leftJoin(string $table, string $condition): self
    {
        $this->sql .= " LEFT JOIN $table ON $condition";
        return $this;
    }

    /**
     * Добавляет RIGHT JOIN
     * @param string $table Имя присоединяемой таблицы
     * @param string $condition Условие соединения
     * @return self
     */
    public function rightJoin(string $table, string $condition): self
    {
        $this->sql .= " RIGHT JOIN $table ON $condition";
        return $this;
    }

    /**
     * Устанавливает GROUP BY
     * @param array $columns Столбцы для группировки (например, ['category', 'status'])
     * @return self
     */
    public function groupBy(array $columns): self
    {
        $colList = implode(', ', $columns);
        $this->sql .= " GROUP BY $colList";
        $this->hasGroupBy = true;
        return $this;
    }

    /**
     * Добавляет HAVING (используется после GROUP BY)
     * @param string $condition Условие (например, 'COUNT(*) > 1')
     * @param array $params Параметры для подготовленного запроса
     * @return self
     */
    public function having(string $condition, array $params = []): self
    {
        if (!$this->hasGroupBy) {
            throw new \LogicException('HAVING can only be used after GROUP BY');
        }
        $this->sql .= " HAVING $condition";
        $this->params = array_merge($this->params, $params);
        return $this;
    }

    /**
     * Устанавливает ORDER BY
     * @param array $columns Массив колонок с направлением сортировки
     *                     Формат: ['name ASC', 'age DESC'] или просто ['name', 'age']
     * @return self
     */
    public function orderBy(array $columns): self
    {
        $orderParts = [];
        foreach ($columns as $column) {
            if (strpos($column, ' ') === false) {
                $orderParts[] = "$column ASC"; // По умолчанию ASC
            } else {
                $orderParts[] = $column;
            }
        }
        $orderClause = implode(', ', $orderParts);
        $this->sql .= " ORDER BY $orderClause";
        return $this;
    }
}
