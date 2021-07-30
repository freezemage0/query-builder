<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\QueryBuilder\Builder;


use Freezemage\QueryBuilder\Condition\Condition;
use Freezemage\QueryBuilder\Condition\Logic;
use Freezemage\QueryBuilder\Contract\Buildable;
use Freezemage\QueryBuilder\Contract\BuilderInterface;
use Freezemage\QueryBuilder\Contract\ConditionChainElementInterface;
use Freezemage\QueryBuilder\Contract\ExpressionInterface;
use Freezemage\QueryBuilder\Contract\ProcessorInterface;
use Freezemage\QueryBuilder\Expression\Column;
use InvalidArgumentException;


class ConditionBuilder implements BuilderInterface {
    private ProcessorInterface $processor;

    public function __construct(ProcessorInterface $processor) {
        $this->processor = $processor;
    }

    public function build(Buildable $buildable): string {
        if (!($buildable instanceof ConditionChainElementInterface)) {
            throw new InvalidArgumentException();
        }

        if ($buildable instanceof Condition) {
            $leftOperand = $buildable->getLeftOperand();
            $rightOperand = $buildable->getRightOperand();

            return sprintf(
                    '%s %s %s',
                    $this->buildOperand($leftOperand),
                    $buildable->getOperator(),
                    $this->buildOperand($rightOperand)
            );
        }

        if ($buildable instanceof Logic) {
            return $buildable->getValue();
        }
    }

    private function buildOperand(ExpressionInterface $operand): string {
        if ($operand instanceof Column) {
            return $this->processor->quote($operand->getValue());
        }

        return $this->processor->escape($operand->getValue());
    }
}