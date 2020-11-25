<?php


namespace Stefmachine\QueryBuilder\Expressions;

use Stefmachine\QueryBuilder\Adapter\QueryAdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;

class Table implements QueryExpressionInterface
{
    protected $table;
    
    public function __construct($_table)
    {
        $this->table = $_table;
    }
    
    public static function from($_table)
    {
        return new static($_table);
    }
    
    public function buildOnQuery(QueryBuilderInterface $_qb, QueryAdapterInterface $_adapter): string
    {
        $table = $this->table instanceof QueryExpressionInterface ?
            $this->table->buildOnQuery($_qb, $_adapter) :
            $_adapter->asIdentifier($this->table);
        
        return $table;
    }
}