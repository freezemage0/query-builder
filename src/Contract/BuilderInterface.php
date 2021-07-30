<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */


namespace Freezemage\QueryBuilder\Contract;


interface BuilderInterface {
    public function build(Buildable $buildable): string;
}