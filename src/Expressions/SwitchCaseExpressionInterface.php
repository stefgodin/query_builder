<?php


namespace Stefmachine\QueryBuilder\Expressions;


interface SwitchCaseExpressionInterface
{
    public function when(QueryExpressionInterface $_when, $_then): SwitchCaseExpressionInterface;
    
    public function else($_defaultValue): SwitchCaseExpressionInterface;
}