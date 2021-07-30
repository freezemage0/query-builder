<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\QueryBuilder\Expression;


use Freezemage\QueryBuilder\Contract\Buildable;
use Freezemage\QueryBuilder\Contract\ExpressionInterface;
use Freezemage\QueryBuilder\Contract\TypeInterface;
use Freezemage\QueryBuilder\Type\IntegerType;
use Freezemage\QueryBuilder\Type\StringType;


class Value implements ExpressionInterface, Buildable {
    private TypeInterface $type;
    private string $value;

    public static function string(string $value): Value {
        return new Value(new StringType(), $value);
    }

    public static function int(string $value): Value {
        return new Value(new IntegerType(), $value);
    }

    public function __construct(TypeInterface $type, string $value) {
        $this->type = $type;
        $this->value = $value;
    }

    public function getValue(): string {
        return $this->type->cast($this->value);
    }
}