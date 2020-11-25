<?php


namespace Stefmachine\QueryBuilder\Expressions;


use Stefmachine\QueryBuilder\Adapter\AdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;

class StarColumn implements QueryExpressionInterface
{
    protected $table;
    
    public function __construct(?string $_table = null)
    {
        $this->table = $_table;
    }
    
    public static function from(string $_table = null)
    {
        return new static($_table);
    }
    
    public function buildOnQuery(QueryBuilderInterface $_qb, AdapterInterface $_adapter): string
    {
        if($this->table){
            $table = $_adapter->asIdentifier($this->table);
            return "{$table}.*";
        }
        
        return "*";
    }
}