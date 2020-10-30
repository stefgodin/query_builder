<?php


namespace Stefmachine\QueryBuilder\Parts;

use Stefmachine\QueryBuilder\Expressions\Join;
use Clyvanor\Persistence\Adapter\AdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;

class JoinedTablesPart implements QueryPartInterface
{
    protected $joins;
    
    public function __construct(Join ...$_joins)
    {
        $this->joins = $_joins;
    }
    
    public static function from(Join ...$_joins)
    {
        return new static(...$_joins);
    }
    
    public function addJoin(Join $_join)
    {
        $this->joins[] = $_join;
    }
    
    public function buildOnQuery(QueryBuilderInterface $_qb, AdapterInterface $_adapter): string
    {
        $parts = array_map(function(Join $_table) use ($_qb, $_adapter){
            return $_table->buildOnQuery($_qb, $_adapter);
        }, $this->joins);
        
        return implode(' ', $parts);
    }
}