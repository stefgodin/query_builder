<?php


namespace Stefmachine\QueryBuilder\Parts;


use Stefmachine\QueryBuilder\Adapter\AdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;
use Stefmachine\QueryBuilder\Expressions\FunctionExpression;
use Stefmachine\QueryBuilder\Expressions\QueryExpressionInterface;

class FunctionPart implements QueryPartInterface
{
    protected $function;
    protected $parameters;
    
    public function __construct(string $_name, array $_parameters)
    {
        $this->function = $_name;
        $this->parameters = $_parameters;
    }
    
    public static function from(string $_name, array $_parameters)
    {
        return new static($_name, $_parameters);
    }
    
    public function buildOnQuery(QueryBuilderInterface $_qb, AdapterInterface $_adapter): string
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