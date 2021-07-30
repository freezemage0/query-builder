<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Freezemage\QueryBuilder\Type;

use Freezemage\QueryBuilder\Contract\TypeInterface;

class IntegerType implements TypeInterface {
    public function cast($value): int {
        return (int) $value;
    }
}