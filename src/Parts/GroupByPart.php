<?php


namespace Stefmachine\QueryBuilder\Parts;

use Stefmachine\QueryBuilder\Expressions\Column;
use Stefmachine\QueryBuilder\Expressions\QueryExpressionInterface;
use Clyvanor\Persistence\Adapter\AdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;

class GroupByPart implements QueryPartInterface
{
    /** @var QueryExpressionInterface[] */
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
        $columns = implode(', ', array_map(function (QueryExpressionInterface $_field) use ($_qb, $_adapter) {
            return $_field->buildOnQuery($_qb, $_adapter);
        }, $this->columns));
        
        return empty($columns) ? "" : "GROUP BY {$columns}";
    }
    
}