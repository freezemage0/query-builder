<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\QueryBuilder\Expression;


use Freezemage\QueryBuilder\Contract\Buildable;
use Freezemage\QueryBuilder\Contract\ExpressionInterface;


class Database implements ExpressionInterface, Buildable {
    private string $name;

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function getName(): string {
        return $this->name;
    }

    public function table(string $name): Table {
        return new Table($this, $name);
    }

    public function getValue(): string {
        return $this->getName();
    }
}