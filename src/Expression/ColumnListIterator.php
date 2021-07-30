<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\QueryBuilder\Expression;


use Iterator;


class ColumnListIterator implements Iterator {
    private int $position;
    private array $columns;
    private int $columnCount;

    public function __construct(ColumnList $columnList) {
        $this->columns = $columnList->toArray();
        $this->columnCount = count($this->columns);
        $this->rewind();
    }

    public function current(): Column {
        return $this->columns[$this->position];
    }

    public function next(): void {
        $this->position += 1;
    }

    public function key(): int {
        return $this->position;
    }

    public function valid(): bool {
        return $this->position < $this->columnCount;
    }

    public function rewind(): void {
        $this->position = 0;
    }
}