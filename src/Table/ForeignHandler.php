<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Table;

use Hindbiswas\QueBee\Table\Values\FK;

class ForeignHandler
{
    protected array $baseColumn;
    protected array $targetColumn;
    protected FK|null $onDeleteValue = null;
    protected FK|null $onUpdateValue = null;

    public function __construct(protected readonly CreateTable $baseTable, string $baseColumn)
    {
        // Initialize baseColumn array with column name and object
        $this->baseColumn = [
            'name' => $baseColumn,
            'column' => $baseTable->getColumn($baseColumn),
        ];
    }

    public function reference(CreateTable $targetTable, string $targetColumn): CreateTable
    {
        // Check if the target column exists in the target table
        if (!$targetTable->hasColumn($targetColumn)) {
            throw new \InvalidArgumentException("`$targetColumn` is not a column of `$targetTable->name` table.");
        }

        // Initialize targetColumn array with column name and object
        $this->targetColumn = [
            'name' => $targetColumn,
            'column' => $targetTable->getColumn($targetColumn),
        ];

        // Check if the columns are compatible for foreign key constraint
        $compatibility = $this->matchColumnCompatibility();
        if ($compatibility !== true) {
            throw $compatibility;
        }

        // Add the foreign key constraint to the base table
        return $this->baseTable->addForeignKey(
            base: $this->baseColumn['name'],
            targetCol: $targetColumn,
            targetTable: $targetTable->name,
            onDelete: $this->onDeleteValue,
            onUpdate: $this->onUpdateValue
        );
    }

    public function onDelete(FK $value): self
    {
        // Check if the base column allows ON DELETE SET NULL
        if ($value === FK::NULL && $this->baseColumn['column']->nullValue() !== 'NULL') {
            throw new \Exception('Base column must be nullable to set ON DELETE to SET NULL');
        }

        // Set the ON DELETE value
        $this->onDeleteValue = $value;
        return $this;
    }

    public function onUpdate(FK $value): self
    {
        // Check if the base column allows ON UPDATE SET NULL
        if ($value === FK::NULL && $this->baseColumn['column']->nullValue() !== 'NULL') {
            throw new \Exception('Base column must be nullable to set ON UPDATE to SET NULL');
        }

        // Set the ON UPDATE value
        $this->onUpdateValue = $value;
        return $this;
    }

    protected function matchColumnCompatibility(): \Exception|bool
    {
        // Check if base and target columns have the same type and attribute
        $base = $this->baseColumn;
        $target = $this->targetColumn;

        if ($base['column']->getType() !== $target['column']->getType()) {
            $msg = "`" . $base['name'] . "` and `" . $target['name'] . "` must be of the same type and length to be foreign key constrained";
            return new \Exception($msg);
        }

        if ($base['column']->getAttribute() !== $target['column']->getAttribute()) {
            $msg = "`" . $base['name'] . "` and `" . $target['name'] . "` must be of the same attribute to be foreign key constrained";
            return new \Exception($msg);
        }

        return true;
    }
}
