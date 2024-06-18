<?php


namespace Stefmachine\QueryBuilder\Expressions;

use Stefmachine\QueryBuilder\Adapter\QueryAdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;

class SwitchExpression implements QueryExpressionInterface, SwitchCaseExpressionInterface
{
    /** @var QueryExpressionInterface|null */
    protected $case;
    /** @var QueryExpressionInterface|mixed|null */
    protected $default;
    /** @var CaseCondition[] */
    protected $conditions;
    
    public function __construct(?QueryExpressionInterface $_expression = null)
    {
        $this->case = $_expression;
        $this->default = null;
        $this->conditions = [];
    }
    
    public function when($_when, $_then): SwitchCaseExpressionInterface
    {
        $this->conditions[] = new CaseCondition($_when, $_then);
        return $this;
    }
    
    public function else($_defaultValue): SwitchCaseExpressionInterface
    {
        $this->default = $_defaultValue;
        return $this;
    }
    
    public function buildOnQuery(QueryBuilderInterface $_qb, QueryAdapterInterface $_adapter): string
    {
        $case = '';
        if($this->case) {
            $case = $this->case->buildOnQuery($_qb, $_adapter) . ' ';
        }
        
        $conditions = [];
        foreach($this->conditions as $condition) {
            $condition = $condition->buildOnQuery($_qb, $_adapter);
            $conditions[] = "WHEN {$condition}";
        }
        $conditions = implode(' ', $conditions);
        
        if($this->default !== null) {
            if($this->default instanceof QueryExpressionInterface) {
                $default = $this->default->buildOnQuery($_qb, $_adapter);
                $default = "({$default})";
            } else {
                $default = $_qb->addParam($this->default);
            }
            $default = "ELSE {$default}";
        } else {
            $default = "";
        }
        
        return "(CASE {$case}{$conditions} {$default} END)";
    }
}