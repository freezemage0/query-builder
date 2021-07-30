<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\QueryBuilder;


use Freezemage\QueryBuilder\Condition\Condition;
use Freezemage\QueryBuilder\Condition\Logic;
use Freezemage\QueryBuilder\Expression\Database;
use Freezemage\QueryBuilder\Expression\Value;
use Freezemage\QueryBuilder\Factory\Query;


class Example {
    public function main(): void {
        $db = new Database('test_db');
        $table = $db->table('users');

        $query = new Query();
        echo $query->select($table->columns(array('ID', 'NAME')))
                ->from($table)
                ->where(Condition::equals($table->column('ID'), Value::int('1')))
                ->logic(Logic::logicalOr())
                ->where(Condition::equals($table->column('NAME'), Value::string('John Smith')))
                ->build();
    }
}