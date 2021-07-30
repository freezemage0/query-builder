<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\QueryBuilder\Contract;


interface ProcessorInterface {
    public function quote(string $identifier): string;

    public function escape(string $value): string;
}