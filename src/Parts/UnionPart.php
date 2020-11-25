<?php


namespace Stefmachine\QueryBuilder\Parts;


use Stefmachine\QueryBuilder\Expressions\QueryExpressionInterface;
use Stefmachine\QueryBuilder\Adapter\QueryAdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;

class UnionPart implements QueryPartInterface
{
    /** @var QueryExpressionInterface[] */
    protected $queries;
    /** @var bool */
    protected $unionAll;
    
    public function __construct(bool $_unionAll, QueryExpressionInterface ...$_queries)
    {
        $this->queries = $_queries;
        $this->unionAll = $_unionAll;
    }
    
    public static function from(bool $_unionAll, QueryExpressionInterface ...$_queries)
    {
        return new static($_unionAll, ...$_queries);
    }
    
    public function buildOnQuery(QueryBuilderInterface $_qb, QueryAdapterInterface $_adapter): string
    {
        $union = $this->unionAll ? 'UNION ALL' : 'UNION';
        
        $unions = implode(" {$union} ", array_map(function(QueryExpressionInterface $_query) use($_qb, $_adapter){
            return $_query->buildOnQuery($_qb, $_adapter);
        }, $this->queries));
        
        return "{$union} {$unions}";
    }
}