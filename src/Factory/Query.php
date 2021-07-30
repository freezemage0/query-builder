<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\QueryBuilder\Factory;


use Freezemage\QueryBuilder\Builder\ColumnBuilder;
use Freezemage\QueryBuilder\Builder\ConditionBuilder;
use Freezemage\QueryBuilder\Builder\TableBuilder;
use Freezemage\QueryBuilder\Expression\ColumnList;
use Freezemage\QueryBuilder\Processor\MysqlProcessor;
use Freezemage\QueryBuilder\Query\Select;


class Query {
    public function select(?ColumnList $columnList): Select {
        $processor = new MysqlProcessor();
        $columnList ??= new ColumnList();

        $select = new Select(
                new TableBuilder($processor),
                new ColumnBuilder($processor),
                new ConditionBuilder($processor)
        );
        $select->setFields($columnList);

        return $select;
    }
}