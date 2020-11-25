<?php


namespace Stefmachine\QueryBuilder\Expressions;


use Stefmachine\QueryBuilder\Adapter\AdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;

class ConvertFunction implements QueryExpressionInterface
{
    protected $value;
    /** @var QueryExpressionInterface|null */
    protected $type;
    
    public function __construct($_value, $_type)
    {
        $this->value = $_value;
        $this->type = $_type instanceof QueryExpressionInterface ? $_type : Expr::literal($_type);
    }
    
    public function buildOnQuery(QueryBuilderInterface $_qb, AdapterInterface $_adapter): string
    {
        if($this->value instanceof QueryExpressionInterface){
            $value = $this->value->buildOnQuery($_qb, $_adapter);
        }
        else{
            $value = $_qb->addParam($this->value);
        }
        
        $type = $this->type->buildOnQuery($_qb, $_adapter);
        
        if($_adapter->getDriverName() == 'mssql'){
            return "CONVERT({$type}, {$value})";
        }
        else if($_adapter->getDriverName() == 'mysql'){
            return "CONVERT({$value}, {$type})";
        }
    
        throw new \RuntimeException("Convert was not implemented for driver {$_adapter->getDriverName()}.");
    }
    
    
}