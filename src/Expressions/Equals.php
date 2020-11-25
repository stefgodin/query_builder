<?php


namespace Stefmachine\QueryBuilder\Expressions;


use Stefmachine\QueryBuilder\Adapter\AdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;

class Equals extends SimpleOperator implements QueryExpressionInterface
{
    public function __construct($_field, $_equals)
    {
        parent::__construct(
            '=',
            $_field instanceof QueryExpressionInterface ? $_field : Column::from($_field),
            $_equals
        );
    }
}