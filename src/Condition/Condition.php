<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\QueryBuilder\Condition;


use Freezemage\QueryBuilder\Contract\Buildable;
use Freezemage\QueryBuilder\Contract\ConditionInterface;
use Freezemage\QueryBuilder\Contract\ExpressionInterface;


class Condition implements ConditionInterface, Buildable {
    private ExpressionInterface $leftOperand;
    private ExpressionInterface $rightOperand;
    private string $operator;

    public static function equals(ExpressionInterface $leftOperand, ExpressionInterface $rightOperand): Condition {
        return new Condition(
                $leftOperand,
                '=',
                $rightOperand
        );
    }

    public function __construct(ExpressionInterface $leftOperand, string $operator, ExpressionInterface $rightOperand) {
        $this->leftOperand = $leftOperand;
        $this->operator = $operator;
        $this->rightOperand = $rightOperand;
    }

    public function getLeftOperand(): ExpressionInterface {
        return $this->leftOperand;
    }

    public function getRightOperand(): ExpressionInterface {
        return $this->rightOperand;
    }

    public function getOperator(): string {
        return $this->operator;
    }
}