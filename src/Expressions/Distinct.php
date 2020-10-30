<?php


namespace Stefmachine\QueryBuilder\Expressions;


use Clyvanor\Persistence\Adapter\AdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;

class Distinct implements QueryExpressionInterface
{
    protected $columns;
    
    public function __construct(...$_columns)
    {
        $this->columns = array_map(function($_column){
            return $_column instanceof QueryExpressionInterface ? $_column : Column::from($_column);
        }, $_columns);
    }
    
    public static function from(...$_columns)
    {
        return new static(...$_columns);
    }
    
    public function buildOnQuery(QueryBuilderInterface $_qb, AdapterInterface $_adapter): string
    {
        $columns = implode(', ', array_map(function(QueryExpressionInterface $_column) use($_qb, $_adapter){
            return $_column->buildOnQuery($_qb, $_adapter);
        }, $this->columns));
        return "DISTINCT {$columns}";
    }
}