<?php


namespace Stefmachine\QueryBuilder\Expressions;


use Stefmachine\QueryBuilder\Adapter\QueryAdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;

class OrX implements QueryExpressionInterface
{
    protected $parts;
    
    public function __construct(QueryExpressionInterface ...$_orX)
    {
        $this->parts = $_orX;
    }
    
    public function buildOnQuery(QueryBuilderInterface $_qb, QueryAdapterInterface $_adapter): string
    {
        $or = [];
        foreach ($this->parts as $part){
            $or[] = $part->buildOnQuery($_qb, $_adapter);
        }
        $or = implode(' OR ', $or);
        return "({$or})";
    }
}