<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\QueryBuilder\Expression;


use Freezemage\QueryBuilder\Contract\Buildable;
use IteratorAggregate;


class ColumnList implements Buildable, IteratorAggregate {
    private array $columns;

    public function __construct() {
        $this->columns = array();
    }

    public function add(Column $column): void {
        $this->columns[] = $column;
    }

    public function toArray(): array {
        return $this->columns;
    }

    public function getIterator(): ColumnListIterator {
        return new ColumnListIterator($this);
    }
}