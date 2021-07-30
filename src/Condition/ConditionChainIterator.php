<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Freezemage\QueryBuilder\Condition;


use Freezemage\QueryBuilder\Contract\ConditionChainElementInterface;
use Iterator;


class ConditionChainIterator implements Iterator {
    private array $conditionChain;
    private int $count;
    private int $position;

    public function __construct(ConditionChain $conditionChain) {
        $this->conditionChain = $conditionChain->toArray();
        $this->count = count($this->conditionChain);
        $this->rewind();
    }

    public function current(): ConditionChainElementInterface {
        return $this->conditionChain[$this->position];
    }

    public function next(): void {
        $this->position += 1;
    }

    public function key(): int {
        return $this->position;
    }

    public function valid(): bool {
        return $this->position < $this->count;
    }

    public function rewind() {
        $this->position = 0;
    }
}