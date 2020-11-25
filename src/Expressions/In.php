<?php


namespace Stefmachine\QueryBuilder\Expressions;


use Stefmachine\QueryBuilder\Adapter\AdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;

class In implements QueryExpressionInterface
{
    /** @var QueryExpressionInterface|string */
    protected $field;
    /** @var array|QueryExpressionInterface */
    protected $values;
    
    public function __construct($_field, $_in)
    {
        $this->field = $_field instanceof QueryExpressionInterface ? $_field : Column::from($_field);
        if(!$_in instanceof QueryExpressionInterface && !is_array($_in)){
            throw new \InvalidArgumentException("Expected IN parameter to be an array or an expression");
        }
        $this->values = $_in;
    }
    
    public function buildOnQuery(QueryBuilderInterface $_qb, AdapterInterface $_adapter): string
    {
        $field = $this->field->buildOnQuery($_qb, $_adapter);
        if(is_array($this->values)){
            $values = [];
            foreach ($this->values as $value){
                if($value instanceof QueryExpressionInterface){
                    $values[] = $value->buildOnQuery($_qb, $_adapter);
                }
                else{
                    $values[] = $_qb->addParam($value);
                }
            }
            $values = implode(',', $values);
        }
        else{
            $values = $this->values->buildOnQuery($_qb, $_adapter);
        }
        return "{$field} IN ({$values})";
    }
}