<?php


namespace Stefmachine\QueryBuilder\Expressions;


use Stefmachine\QueryBuilder\Adapter\AdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;

class Alias implements QueryExpressionInterface
{
    protected $expression;
    protected $alias;
    
    public function __construct(QueryExpressionInterface $_expr, string $_alias)
    {
        $this->expression = $_expr;
        $this->alias = $_alias;
    }
    
    public static function from(QueryExpressionInterface $_expr, string $_alias)
    {
        return new static($_expr, $_alias);
    }
    
    public function buildOnQuery(QueryBuilderInterface $_qb, AdapterInterface $_adapter): string
    {
        return "{$this->expression->buildOnQuery($_qb, $_adapter)} AS {$_adapter->asIdentifier($this->alias)}";
    }
}