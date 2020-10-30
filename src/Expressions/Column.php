<?php


namespace Stefmachine\QueryBuilder\Expressions;


use Clyvanor\Persistence\Adapter\AdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;

class Column implements QueryExpressionInterface
{
    protected $column;
    
    public function __construct($_column)
    {
        if(!is_string($_column) && !$_column instanceof QueryExpressionInterface){
            throw new \InvalidArgumentException("Invalid column given. Expected string or query expression");
        }
        
        $this->column = $_column;
    }
    
    public static function from($_column)
    {
        return new static($_column);
    }
    
    public function buildOnQuery(QueryBuilderInterface $_qb, AdapterInterface $_adapter): string
    {
        return $this->column instanceof QueryExpressionInterface ?
            "({$this->column->buildOnQuery($_qb, $_adapter)})" :
            $_adapter->asIdentifier($this->column);
    }
}