<?php


namespace Stefmachine\QueryBuilder\Expressions;

class Like extends SimpleOperator implements QueryExpressionInterface
{
    public function __construct($_field, $_like)
    {
        parent::__construct(
            'LIKE',
            $_field instanceof QueryExpressionInterface ? $_field : Column::from($_field),
            $_like
        );
    }
}