<?php


namespace Stefmachine\QueryBuilder\Expressions;


use Stefmachine\QueryBuilder\Adapter\AdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;

class IsNull implements QueryExpressionInterface
{
    protected $field;
    
    public function __construct($_field)
    {
        $this->field = $_field instanceof QueryExpressionInterface ? $_field : Column::from($_field);
    }
    
    public function buildOnQuery(QueryBuilderInterface $_qb, AdapterInterface $_adapter): string
    {
        $field = $this->field->buildOnQuery($_qb, $_adapter);
        return "{$field} IS NULL";
    }
}