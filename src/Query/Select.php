<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\QueryBuilder\Query;


use Freezemage\QueryBuilder\Builder\ColumnBuilder;
use Freezemage\QueryBuilder\Builder\ConditionBuilder;
use Freezemage\QueryBuilder\Builder\TableBuilder;
use Freezemage\QueryBuilder\Condition\ConditionChain;
use Freezemage\QueryBuilder\Condition\Logic;
use Freezemage\QueryBuilder\Contract\ConditionInterface;
use Freezemage\QueryBuilder\Contract\QueryInterface;
use Freezemage\QueryBuilder\Expression\ColumnList;
use Freezemage\QueryBuilder\Expression\Table;


class Select implements QueryInterface {
    private TableBuilder     $tableBuilder;
    private ColumnBuilder    $columnBuilder;
    private ConditionBuilder $conditionBuilder;

    private Table          $table;
    private ColumnList     $fields;
    private ConditionChain $whereConditions;

    public function __construct(TableBuilder $tableBuilder, ColumnBuilder $columnBuilder, ConditionBuilder $conditionBuilder) {
        $this->tableBuilder = $tableBuilder;
        $this->columnBuilder = $columnBuilder;
        $this->conditionBuilder = $conditionBuilder;
    }

    public function setFields(ColumnList $columns): Select {
        $this->fields = $columns;
        return $this;
    }

    public function from(Table $table): Select {
        $this->table = $table;
        return $this;
    }

    public function where(ConditionInterface $condition): Select {
        if (!isset($this->whereConditions)) {
            $this->whereConditions = new ConditionChain();
        }

        $this->whereConditions->push($condition);
        return $this;
    }

    public function logic(Logic $logic): Select {
        $this->whereConditions->push($logic);
        return $this;
    }

    public function build(): string {
        $fields = $this->buildFields();
        $conditions = $this->buildConditions();


    }

    /**
     * @return string
     */
    protected function buildFields(): string {
        $fields = array();
        foreach ($this->fields as $column) {
            $fields[] = $this->columnBuilder->build($column);
        }
        return implode(', ', $fields);
    }

    /**
     * @return string|null
     */
    protected function buildConditions(): ?string {
        if (!isset($this->whereConditions)) {
            return null;
        }

        $conditions = array();
        foreach ($this->whereConditions as $condition) {
            $conditions[] = $this->conditionBuilder->build($condition);
        }
        return implode(' ', $conditions);
    }
}