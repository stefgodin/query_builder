<?php


namespace Stefmachine\QueryBuilder\Expressions;


use Stefmachine\QueryBuilder\Adapter\QueryAdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;

class Binary implements QueryExpressionInterface
{
    protected $value;
    
    public function __construct($_value)
    {
        $this->value = $_value;
    }
    
    public function buildOnQuery(QueryBuilderInterface $_qb, QueryAdapterInterface $_adapter): string
    {
        if($this->value instanceof QueryExpressionInterface){
            $value = $this->value->buildOnQuery($_qb, $_adapter);
        }
        else{
            $value = $_qb->addParam($this->value);
        }
        
        return "BINARY {$value}";
    }
}