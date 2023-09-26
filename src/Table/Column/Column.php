<?php

declare(strict_types=1);

namespace Hindbiswas\QueBee\Table\Column;

use Hindbiswas\QueBee\Table\Traits\Constraint;
use Hindbiswas\QueBee\Table\Traits\DefaultValue;
use Hindbiswas\QueBee\Table\Traits\Nullable;

class Column implements ColumnInterface
{
    use Nullable; // Trait for handling nullable property.
    use DefaultValue; // Trait for handling default value property.
    use Constraint; // Trait for handling column constraints.

    protected string|null $attribute = null; // Stores the attribute (e.g., UNSIGNED).
    protected string $type; // Stores the data type of the column.
    protected $ai = false; // Stores whether the column is AUTO_INCREMENT.

    public function build(string $name): string
    {
        $sql = "`$name` " . $this->type . " "; // Initialize SQL with column name and data type.
        $sql .= ($this->attribute) ? $this->attribute . " " . $this->nullValue() : $this->nullValue(); // Add attribute and nullability.
        if ($this->defaultValue()) {
            $sql .= " DEFAULT " . $this->defaultValue(); // Add default value.
        }
        if (strpos($this->type, 'INT') !== false && $this->ai) {
            $sql .= " AUTO_INCREMENT"; // Add AUTO_INCREMENT for INT columns.
        }
        return $sql; // Return the final column definition SQL.
    }

    public function getType(): string
    {
        return $this->type; // Get the data type of the column.
    }

    public function getAttribute(): string|null
    {
        return $this->attribute; // Get the attribute (e.g., UNSIGNED) of the column.
    }
}
