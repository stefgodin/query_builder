<?php


namespace Stefmachine\QueryBuilder\Expressions;


use Stefmachine\QueryBuilder\Adapter\QueryAdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;

class NotNull implements QueryExpressionInterface
{
    protected $field;
    
    public function __construct($_field)
    {
        $this->field = $_field instanceof QueryExpressionInterface ? $_field : Column::from($_field);
    }
    
    public function buildOnQuery(QueryBuilderInterface $_qb, QueryAdapterInterface $_adapter): string
    {
        $field = $this->field->buildOnQuery($_qb, $_adapter);
        return "{$field} IS NOT NULL";
    }
}