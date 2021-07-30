<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\QueryBuilder\Builder;


use Freezemage\QueryBuilder\Contract\Buildable;
use Freezemage\QueryBuilder\Contract\BuilderInterface;
use Freezemage\QueryBuilder\Contract\ProcessorInterface;
use Freezemage\QueryBuilder\Expression\Column;
use InvalidArgumentException;


class ColumnBuilder implements BuilderInterface {
    private ProcessorInterface $processor;

    public function __construct(ProcessorInterface $processor) {
        $this->processor = $processor;
    }

    public function build(Buildable $buildable): string {
        if (!($buildable instanceof Column)) {
            throw new InvalidArgumentException;
        }

        return sprintf(
                '%s.%s AS %s',
                $this->processor->quote($buildable->getTable()->getAlias()),
                $this->processor->quote($buildable->getName()),
                $this->processor->quote($buildable->getAlias())
        );
    }
}