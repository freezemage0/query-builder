<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\QueryBuilder\Processor;


use Freezemage\QueryBuilder\Contract\ProcessorInterface;


class MysqlProcessor implements ProcessorInterface {
    public function quote(string $identifier): string {
        return sprintf('`%s`', trim($identifier, '`'));
    }

    public function escape(string $value): string {
        return $value; // requires mysql_real_escape_string, but we have no connection in dev phase... todo: remove this
    }
}