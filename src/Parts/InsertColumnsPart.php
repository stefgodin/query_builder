<?php


namespace Stefmachine\QueryBuilder\Parts;

use Stefmachine\QueryBuilder\Expressions\Column;
use Clyvanor\Persistence\Adapter\AdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;

class InsertColumnsPart implements QueryPartInterface
{
    /**
     * @var Column[]
     */
    protected $columns;
    
    public function __construct(array $_columns)
    {
        $this->columns = array_map(function($_column){
            return Column::from($_column);
        }, $_columns);
    }
    
    public static function from(array $_columns)
    {
        return new static($_columns);
    }
    
    public function buildOnQuery(QueryBuilderInterface $_qb, AdapterInterface $_adapter): string
    {
        $columns = implode(', ', array_map(function (Column $_field) use ($_qb, $_adapter) {
            return $_field->buildOnQuery($_qb, $_adapter);
        }, $this->columns));
        
        return empty($columns) ? "" : "({$columns})";
    }
    
}