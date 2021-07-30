<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\QueryBuilder\Condition;


use Freezemage\QueryBuilder\Contract\ConditionChainElementInterface;
use IteratorAggregate;
use LogicException;


class ConditionChain implements IteratorAggregate {
    private array $conditions;

    public function __construct() {
        $this->conditions = array();
    }

    public function push(ConditionChainElementInterface $element): void {
        $lastElement = end($this->conditions);
        if ($lastElement instanceof Logic && $element instanceof Logic) {
            throw new LogicException;
        }

        if ($lastElement instanceof Condition && $element instanceof Condition) {
            $this->conditions[] = Logic::logicalAnd();
        }

        $this->conditions[] = $element;
    }

    public function toArray(): array {
        return $this->conditions;
    }

    public function getIterator(): ConditionChainIterator {
        return new ConditionChainIterator($this);
    }
}