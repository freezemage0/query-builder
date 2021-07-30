<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Freezemage\QueryBuilder\Type;


use Freezemage\QueryBuilder\Contract\TypeInterface;


class StringType implements TypeInterface {
    public function cast($value): string {
        return sprintf('"%s"', (string) $value);
    }
}