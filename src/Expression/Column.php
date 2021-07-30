<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\QueryBuilder\Expression;


use Freezemage\QueryBuilder\Contract\Buildable;
use Freezemage\QueryBuilder\Contract\ExpressionInterface;


class Column implements ExpressionInterface, Buildable {
    private Table $table;
    private string $name;
    private ?string $alias;

    public function __construct(Table $table, string $name, ?string $alias = null) {
        $this->table = $table;
        $this->name = $name;
        $this->alias = $alias;
    }

    public function getTable(): Table {
        return $this->table;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getAlias(): string {
        return $this->alias ??= $this->name;
    }

    public function setAlias(string $alias): void {
        $this->alias = $alias;
    }

    public function getValue() : string{
        return $this->getAlias();
    }
}