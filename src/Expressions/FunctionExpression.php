<?php


namespace Stefmachine\QueryBuilder\Expressions;


use Stefmachine\QueryBuilder\Adapter\QueryAdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;

class FunctionExpression implements QueryExpressionInterface
{
    protected $function;
    protected $parameters;
    
    public function __construct(string $_name, ...$_parameters)
    {
        $this->function = $_name;
        $this->parameters = $_parameters;
    }
    
    public static function from(string $_name, ...$_parameters)
    {
        return new static($_name, $_parameters);
    }
    
    public function buildOnQuery(QueryBuilderInterface $_qb, QueryAdapterInterface $_adapter): string
    {
        $params = [];
        foreach ($this->parameters as $parameter){
            if($parameter instanceof QueryExpressionInterface){
                $params[] = $parameter->buildOnQuery($_qb, $_adapter);
            }
            else{
                $params[] = $_qb->addParam($parameter);
            }
        }
        $params = implode(', ', $params);
        return "{$this->function}($params)";
    }
}