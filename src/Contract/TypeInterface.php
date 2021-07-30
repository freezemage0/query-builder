<?php
/** @author Demyan Seleznev <seleznev@intervolga.ru> */

namespace Freezemage\QueryBuilder\Contract;


interface TypeInterface {
    public function cast($value);
}