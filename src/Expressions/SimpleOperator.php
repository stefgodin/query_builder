<?php


namespace Stefmachine\QueryBuilder\Expressions;


use Stefmachine\QueryBuilder\Adapter\QueryAdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;

class SimpleOperator implements QueryExpressionInterface
{
    protected $operator;
    protected $left;
    protected $right;
    
    public function __construct(string $_operator, $_leftValue, $_rightValue)
    {
        $this->operator = $_operator;
        $this->left = $_leftValue;
        $this->right = $_rightValue;
    }
    
    public function buildOnQuery(QueryBuilderInterface $_qb, QueryAdapterInterface $_adapter): string
    {
        if($this->left instanceof QueryExpressionInterface){
            $left = $this->left->buildOnQuery($_qb, $_adapter);
        }
        else{
            $left = $_qb->addParam($this->left);
        }
        
        if($this->right instanceof QueryExpressionInterface){
            $right = $this->right->buildOnQuery($_qb, $_adapter);
        }
        else{
            $right = $_qb->addParam($this->right);
        }
        return "{$left} {$this->operator} {$right}";
    }
}