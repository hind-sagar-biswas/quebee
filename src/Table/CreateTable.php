<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Table;

use Hindbiswas\QueBee\Table\Column\ColumnInterface;
use Hindbiswas\QueBee\Table\Values\FK;

class CreateTable
{
    protected array $columnList; // Stores column definitions.
    protected array $columns; // Stores column definitions.
    protected array $constraints = [
        'UNIQUE' => [],         // Stores UNIQUE constraints.
        'PRIMARY KEY' => [],    // Stores PRIMARY KEY constraints.
    ];
    protected array $foreignList = []; // Stores FOREIGN KEY constraints.

    public function __construct(public readonly string $name)
    {
        // Constructor initializes the table name.
    }

    public function columns(array $columns): self
    {
        if (array_is_list($columns)) {
            throw new \InvalidArgumentException("Columns must be an associative array");
        }
        $this->columnList = $columns; // Set the column definitions.

        $this->columns = [];

        foreach ($this->columnList as $columnName => $columnObject) {
            if ($columnObject instanceof ColumnInterface) {
                $columnConstraints = $columnObject->getConstraints();
                if (!empty($columnConstraints)) {
                    $this->constraints[$columnConstraints][] = $columnName;
                }
                $this->columns[] = $columnObject->build($columnName); // Build column SQL.
            }
        }
        return $this;
    }

    public function foreign(string $baseColumn): ForeignHandler
    {
        if (!$this->hasColumn($baseColumn)) {
            throw new \InvalidArgumentException("`$baseColumn` is not a column of `$this->name` table.");
        }
        return new ForeignHandler($this, $baseColumn); // Create a ForeignHandler instance.
    }

    public function addForeignKey(string $base, string $targetCol, string $targetTable, FK|null $onDelete = null, FK|null $onUpdate = null): self
    {
        // Add a FOREIGN KEY constraint to the foreignList.
        $key = "FOREIGN KEY ($base) REFERENCES $targetTable($targetCol)";
        if ($onDelete) {
            $key .= " ON DELETE " . $onDelete->name;
        }
        if ($onUpdate) {
            $key .= " ON UPDATE " . $onUpdate->name;
        }
        $this->foreignList[] = $key;
        return $this;
    }

    public function hasColumn(string $columnName): bool
    {
        // Check if a column exists in columnList.
        return array_key_exists($columnName, $this->columnList);
    }

    public function getColumn(string $columnName)
    {
        if (!$this->hasColumn($columnName)) {
            throw new \InvalidArgumentException("`$columnName` is not a column of `$this->name` table.");
        }
        return $this->columnList[$columnName]; // Get a column definition.
    }

    public function get_pk(): string
    {
        return $this->constraints['PRIMARY KEY'][0];
    }

    public function get_all_pk(): array
    {
        return $this->constraints['PRIMARY KEY'];
    }

    public function build(): string
    {
        

        foreach ($this->constraints['PRIMARY KEY'] as $columnName) {
            $keyName = $this->name . "_PK";
            $constraintStr = "CONSTRAINT $keyName PRIMARY KEY (" . implode(', ', $this->constraints['PRIMARY KEY']) . ")";
            $this->columns[] = $constraintStr; // Add PRIMARY KEY constraint to columns.
        }

        foreach ($this->constraints['UNIQUE'] as $columnName) {
            $keyName = $columnName . "_UC";
            $constraintStr = "CONSTRAINT $keyName UNIQUE (`$columnName`)";
            $this->columns[] = $constraintStr; // Add UNIQUE constraint to columns.
        }

        foreach ($this->foreignList as $query) {
            $this->columns[] = $query; // Add FOREIGN KEY constraints to columns.
        }

        $sql = "CREATE TABLE IF NOT EXISTS $this->name (" . implode(', ', $this->columns) . ") ENGINE = InnoDB;"; // Build CREATE TABLE SQL.

        return $sql;
    }
}
