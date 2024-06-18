<?php


namespace Stefmachine\QueryBuilder\Expressions;

use Stefmachine\QueryBuilder\Adapter\QueryAdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;

class CaseCondition implements QueryExpressionInterface
{
    protected $condition;
    protected $result;
    
    public function __construct($_when, $_then)
    {
        $this->condition = $_when;
        $this->result = $_then;
    }
    
    public static function from(QueryExpressionInterface $_when, $_then)
    {
        return new static($_when, $_then);
    }
    
    public function buildOnQuery(QueryBuilderInterface $_qb, QueryAdapterInterface $_adapter): string
    {
        if($this->condition instanceof QueryExpressionInterface) {
            $condition = $this->condition->buildOnQuery($_qb, $_adapter);
        } else {
            $condition = $_qb->addParam($this->condition);
        }
        
        if($this->result instanceof QueryExpressionInterface) {
            $result = $this->result->buildOnQuery($_qb, $_adapter);
            $result = "({$result})";
        } else {
            $result = $_qb->addParam($this->result);
        }
        
        return "{$condition} THEN {$result}";
    }
}