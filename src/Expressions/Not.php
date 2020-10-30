<?php


namespace Stefmachine\QueryBuilder\Expressions;


use Clyvanor\Persistence\Adapter\AdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;

class Not implements QueryExpressionInterface
{
    protected $expression;
    
    public function __construct(QueryExpressionInterface $_expr)
    {
        $this->expression = $_expr;
    }
    
    public function buildOnQuery(QueryBuilderInterface $_qb, AdapterInterface $_adapter): string
    {
        return "NOT {$this->expression->buildOnQuery($_qb, $_adapter)}";
    }
}