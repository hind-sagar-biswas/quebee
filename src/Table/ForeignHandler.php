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
        $this->baseColumn = [
            'name' => $baseColumn,
            'column' => $baseTable->getColumn($baseColumn),
        ];
    }

    public function to(CreateTable $targetTable, string $targetColumn): CreateTable
    {
        if (!$targetTable->hasColumn($targetColumn)) throw new \InvalidArgumentException("`$targetColumn` is not a column of `$targetTable->name` table.");

        $this->targetColumn = [
            'name' => $targetColumn,
            'column' => $targetTable->getColumn($targetColumn),
        ];

        $compatibility = $this->matchColumnCompatibility();
        if ($compatibility !== true) throw $compatibility;

        return $this->baseTable->addForeignKey(
            name: $this->baseColumn['name'] . "_" . $targetColumn . "_FOREIGN_KEY",
            base: $this->baseColumn['name'],
            targetCol: $targetColumn,
            targetTable: $targetTable->name,
            onDelete: $this->onDeleteValue,
            onUpdate: $this->onUpdateValue
        );
    }

    public function onDelete(FK $value): self
    {
        if ($value === FK::NULL && $this->baseColumn['column']->nullValue() !== 'NULL')
            throw new \Exception('Base column must be nullable to set ON DELETE to SET NULL');
        $this->onDeleteValue = $value;
        return $this;
    }

    public function onUpdate(FK $value): self
    {
        if ($value === FK::NULL && $this->baseColumn['column']->nullValue() !== 'NULL')
            throw new \Exception('Base column must be nullable to set ON UPDATE to SET NULL');
        $this->onDeleteValue = $value;
        return $this;
    }

    protected function matchColumnCompatibility(): \Exception|bool
    {
        $base = $this->baseColumn;
        $target = $this->targetColumn;
        if ($base['column']->getType() !== $target['column']->getType()) {
            $msg = "`" . $base['name'] . "` and `" . $target['name'] . "` must be of same type and length to be foreign key constrained";
            return new \Exception($msg);
        }
        if ($base['column']->getAttribute() !== $target['column']->getAttribute()) {
            $msg = "`" . $base['name'] . "` and `" . $target['name'] . "` must be of same attribute to be foreign key constrained";
            return new \Exception($msg);
        }

        return true;
    }
}
