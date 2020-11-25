<?php


namespace Stefmachine\QueryBuilder\Expressions;


use Stefmachine\QueryBuilder\Adapter\QueryAdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;

class Identifier implements QueryExpressionInterface
{
    protected $identifier;
    
    public function __construct(string $_identifier)
    {
        if(!is_string($_identifier) && !$_identifier instanceof QueryExpressionInterface){
            throw new \InvalidArgumentException("Invalid column given. Expected string or query expression");
        }
        
        $this->identifier = $_identifier;
    }
    
    public static function from(string $_identifier)
    {
        return new static($_identifier);
    }
    
    public function buildOnQuery(QueryBuilderInterface $_qb, QueryAdapterInterface $_adapter): string
    {
        return $_adapter->asIdentifier($this->identifier);
    }
}