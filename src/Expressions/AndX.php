<?php


namespace Stefmachine\QueryBuilder\Expressions;

use Clyvanor\Persistence\Adapter\AdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;

class AndX implements QueryExpressionInterface
{
    protected $parts;
    
    public function __construct(QueryExpressionInterface ...$_andX)
    {
        $this->parts = $_andX;
    }
    
    public function buildOnQuery(QueryBuilderInterface $_qb, AdapterInterface $_adapter): string
    {
        $and = [];
        foreach ($this->parts as $part){
            $and[] = $part->buildOnQuery($_qb, $_adapter);
        }
        $and = implode(' AND ', $and);
        return "({$and})";
    }
}