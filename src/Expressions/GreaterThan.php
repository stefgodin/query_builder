<?php


namespace Stefmachine\QueryBuilder\Expressions;


use Stefmachine\QueryBuilder\Adapter\QueryAdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;

class GreaterThan extends SimpleOperator implements QueryExpressionInterface
{
    public function __construct($_field, $_greaterThan)
    {
        parent::__construct(
            '>',
            $_field instanceof QueryExpressionInterface ? $_field : Column::from($_field),
            $_greaterThan
        );
    }
}