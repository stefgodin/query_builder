<?php


namespace Stefmachine\QueryBuilder\Expressions;


use Stefmachine\QueryBuilder\Adapter\AdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;

class Value implements QueryExpressionInterface
{
    protected $value;
    
    public function __construct($_value)
    {
        $this->value = $_value;
    }
    
    public function buildOnQuery(QueryBuilderInterface $_qb, AdapterInterface $_adapter): string
    {
        return $_qb->addParam($this->value);
    }
}