<?php


namespace Stefmachine\QueryBuilder\Expressions;


use Stefmachine\QueryBuilder\Adapter\AdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;

class SwitchExpression implements QueryExpressionInterface, SwitchCaseExpressionInterface
{
    /** @var QueryExpressionInterface|mixed|null */
    protected $default;
    /** @var CaseCondition[] */
    protected $conditions;
    
    public function __construct()
    {
        $this->default = null;
        $this->conditions = array();
    }
    
    public function when(QueryExpressionInterface $_when, $_then): SwitchCaseExpressionInterface
    {
        $this->conditions[] = new CaseCondition($_when, $_then);
        return $this;
    }
    
    public function else($_defaultValue): SwitchCaseExpressionInterface
    {
        $this->default = $_defaultValue;
        return $this;
    }
    
    public function buildOnQuery(QueryBuilderInterface $_qb, AdapterInterface $_adapter): string
    {
        $conditions = [];
        foreach ($this->conditions as $condition){
            $condition = $condition->buildOnQuery($_qb, $_adapter);
            $conditions[] = "WHEN {$condition}";
        }
        $conditions = implode(' ', $conditions);
        
        if($this->default !== null){
            if($this->default instanceof QueryExpressionInterface){
                $default = $this->default->buildOnQuery($_qb, $_adapter);
                $default = "({$default})";
            }
            else{
                $default = $_qb->addParam($this->default);
            }
            $default = "ELSE {$default}";
        }
        else{
            $default = "";
        }
        
        return "(CASE {$conditions} {$default} END)";
    }
}