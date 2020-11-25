<?php


namespace Stefmachine\QueryBuilder\Parts;


use Stefmachine\QueryBuilder\Expressions\Alias;
use Stefmachine\QueryBuilder\Expressions\Column;
use Stefmachine\QueryBuilder\Expressions\QueryExpressionInterface;

use Stefmachine\QueryBuilder\Expressions\StarColumn;
use Stefmachine\QueryBuilder\Adapter\QueryAdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;

class SelectColumnsPart implements QueryPartInterface
{
    /** @var QueryExpressionInterface[] */
    protected $fields;
    
    public function __construct(array $_fields = array())
    {
        $this->fields = array_map(function ($_field, $_key){
            if($_field instanceof Alias || $_field instanceof StarColumn){
                return $_field;
            }
            
            if($_field instanceof Column){
                $column = $_field;
            }
            else{
                $column = Column::from($_field);
            }
            
            if(is_string($_key)){
                $column = Alias::from($column, $_key);
            }
            
            return $column;
        }, $_fields, array_keys($_fields));
        
        if(count($this->fields) == 0){
            $this->fields[] = StarColumn::from();
        }
    }
    
    public static function from(array $_fields = array())
    {
        return new static($_fields);
    }
    
    public function buildOnQuery(QueryBuilderInterface $_qb, QueryAdapterInterface $_adapter): string
    {
        return implode(', ', array_map(function(QueryExpressionInterface $_field) use ($_qb, $_adapter){
            return $_field->buildOnQuery($_qb, $_adapter);
        }, $this->fields));
    }
}