<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\QueryBuilder\Condition;


use Freezemage\QueryBuilder\Contract\ConditionChainElementInterface;
use Freezemage\QueryBuilder\Contract\ExpressionInterface;


class Logic implements ExpressionInterface, ConditionChainElementInterface {
    private string $logic;

    public static function logicalAnd(): Logic {
        return new Logic('AND');
    }

    public static function logicalOr(): Logic {
        return new Logic('OR');
    }

    private function __construct(string $logic) {
        $this->logic = $logic;
    }

    public function getValue(): string {
        return $this->logic;
    }
}