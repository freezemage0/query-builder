<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\QueryBuilder\Expression;


use Freezemage\QueryBuilder\Contract\Buildable;
use Freezemage\QueryBuilder\Contract\ExpressionInterface;


class Table implements ExpressionInterface, Buildable {
    private Database $database;
    private string $name;
    private ?string $alias;

    public function __construct(Database $database, string $name, ?string $alias = null) {
        $this->database = $database;
        $this->name = $name;
        $this->alias = $alias;
    }

    public function getDatabase(): Database {
        return $this->database;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getAlias(): string {
        if (!isset($this->alias)) {
            $parts = explode('_', $this->name);
            $parts = array_map(fn (string $part) => substr($part, 0, 1), $parts);

            $this->alias = implode($parts);
        }

        return $this->alias;
    }

    public function setAlias(string $alias): void {
        $this->alias = $alias;
    }

    public function column(string $name): Column {
        return new Column($this, $name);
    }

    public function columns(array $names): ColumnList {
        $columnList = new ColumnList();
        foreach ($names as $name) {
            $columnList->add($this->column($name));
        }

        return $columnList;
    }

    public function getValue() : string {
        return $this->getAlias();
    }
}