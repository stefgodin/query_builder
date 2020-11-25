<?php


namespace Stefmachine\QueryBuilder\Parts;


use Stefmachine\QueryBuilder\Expressions\Column;
use Stefmachine\QueryBuilder\Expressions\QueryExpressionInterface;

use Stefmachine\QueryBuilder\Adapter\QueryAdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;

class UpdateValuesPart implements QueryPartInterface
{
    protected $data;
    
    public function __construct(array $_data)
    {
        $this->data = $_data;
        
        if(count($this->data) == 0){
            throw new \LogicException("Expected at least one value to update.");
        }
    }
    
    public static function from(array $_data)
    {
        return new static($_data);
    }
    
    public function buildOnQuery(QueryBuilderInterface $_qb, QueryAdapterInterface $_adapter): string
    {
        $set = array();
        foreach ($this->data as $field => $value){
            $field = Column::from($field)->buildOnQuery($_qb, $_adapter);
            if($value instanceof QueryExpressionInterface){
                $value = $value->buildOnQuery($_qb, $_adapter);
                $set[] = "{$field} = {$value}";
            }
            else{
                $param = $_qb->addParam($value);
                $set[] = "{$field} = {$param}";
            }
        }
    
        return implode(', ', $set);
    }
    
}