<?php


namespace Stefmachine\QueryBuilder\Expressions;


use Stefmachine\QueryBuilder\Adapter\QueryAdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;

class NotEqual extends SimpleOperator implements QueryExpressionInterface
{
    public function __construct($_field, $_notEqual)
    {
        parent::__construct(
            '<>',
            $_field instanceof QueryExpressionInterface ? $_field : Column::from($_field),
            $_notEqual
        );
    }
}