<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\QueryBuilder\Contract;


interface ConditionInterface extends ConditionChainElementInterface {
    public function getLeftOperand(): ExpressionInterface;

    public function getRightOperand(): ExpressionInterface;

    public function getOperator(): string;
}