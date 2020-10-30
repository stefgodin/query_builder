<?php


namespace Stefmachine\QueryBuilder\Parts;


use Stefmachine\QueryBuilder\Expressions\QueryExpressionInterface;
use Clyvanor\Persistence\Adapter\AdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;

class InsertValuesPart implements QueryPartInterface
{
    /** @var array[] */
    protected $data;
    /** @var string[] */
    protected $columns;
    
    public function __construct(array $_data)
    {
        $this->data = $_data;
    
        if(count($this->data) == 0){
            throw new \LogicException("Expected at least one set of values to insert.");
        }
    
        $this->columns = array_keys(array_values($this->data)[0]);
    }
    
    public static function from(array $_data)
    {
        return new static($_data);
    }
    
    public function buildOnQuery(QueryBuilderInterface $_qb, AdapterInterface $_adapter): string
    {
        $inserts = array();
        $columns = null;
        foreach ($this->data as $index => $fields) {
            $insert = array();
            foreach ($this->columns as $field) {
                if(!array_key_exists($field, $fields)){
                    throw new \RuntimeException("Missing field '{$field}' from insert value data set at index {$index}.");
                }
                
                $currentField = $fields[$field];
                if($currentField instanceof QueryExpressionInterface){
                    $insert[] = $currentField->buildOnQuery($_qb, $_adapter);
                }
                else{
                    $insert[] = $_qb->addParam($currentField);
                }
            }
            $insert = implode(', ', $insert);
            $inserts[] = "({$insert})";
        }
    
        return implode(', ', $inserts);
    }
    
}