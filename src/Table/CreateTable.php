<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Table;

use Hindbiswas\QueBee\Table\Column\ColumnInterface;

class CreateTable
{
    protected array $columnList;

    public function __construct(public readonly string $name)
    {
    }

    public function columns(array $columns): self
    {
        if (array_is_list($columns)) throw new \InvalidArgumentException("Columns must be associative array");
        $this->columnList = $columns;
        return $this;
    }

    public function foreigns(array $constrains): self
    {
        return $this;
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
