<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Table;

use Hindbiswas\QueBee\Table\Column\ColumnInterface;
use Hindbiswas\QueBee\Table\Values\FK;

class CreateTable
{
    protected array $columnList;
    protected array $foreignList = [];

    public function __construct(public readonly string $name)
    {
    }

    public function columns(array $columns): self
    {
        if (array_is_list($columns)) throw new \InvalidArgumentException("Columns must be associative array");
        $this->columnList = $columns;
        return $this;
    }

    public function foreign(string $baseColumn): ForeignHandler
    {
        if (!$this->hasColumn($baseColumn)) throw new \InvalidArgumentException("`$baseColumn` is not a column of `$this->name` table.");
        return new ForeignHandler($this, $baseColumn);
    }

    public function addForeignKey(string $name, string $base, string $targetCol, string $targetTable, FK|null $onDelete = null, FK|null $onUpdate = null): self
    {
        $key = "FOREIGN KEY ($base) REFERENCES $targetTable ($targetCol)";
        if ($onDelete) $key .= " ON DELETE " . $onDelete->name;
        if ($onUpdate) $key .= " ON UPDATE " . $onUpdate->name;

        $this->foreignList[$name] = $key;
        return $this;
    }

    public function hasColumn(string $columnName): bool
    {
        return array_key_exists($columnName, $this->columnList);
    }

    public function getColumn(string $columnName)
    {
        if (!$this->hasColumn($columnName)) throw new \InvalidArgumentException("`$columnName` is not a column of `$this->name` table.");
        return $this->columnList[$columnName];
    }

    public function build(): string
    {
        $columns = [];
        $constrains = [
            'UNIQUE' => [],
            'PRIMARY KEY' => [],
        ];
        foreach ($this->columnList as $columnName => $columnObject) {
            if ($columnObject instanceof ColumnInterface) {
                if ($columnObject->getConstraints()) $constrains[$columnObject->getConstraints()][] = $columnName;
                $columns[] = $columnObject->build($columnName);
            }
        }

        if (!empty($constrains['PRIMARY KEY'])) {
            $keyName = $this->name . "_PK";
            $constraintStr = "CONSTRAINT $keyName PRIMARY KEY (" . implode(', ', $constrains['PRIMARY KEY']) . ")";
            $columns[] = $constraintStr;
        }

        foreach ($constrains['UNIQUE'] as $columnName) {
            $keyName = $columnName . "_UC";
            $constraintStr = "CONSTRAINT $keyName UNIQUE (`" . $columnName . "`)";
            $columns[] = $constraintStr;
        }

        $sql = "CREATE TABLE IF NOT EXISTS $this->name (" . implode(', ', $columns) . ") ENGINE = InnoDB;";

        return $sql;
    }
}
