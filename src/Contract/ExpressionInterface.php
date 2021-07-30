<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\QueryBuilder\Contract;


interface ExpressionInterface {
    /**
     * May return practically anything since it is an expression.
     *
     * @return string
     */
    public function getValue(): string;
}