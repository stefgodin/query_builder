<?php


namespace Stefmachine\QueryBuilder\Expressions;


use Stefmachine\QueryBuilder\Adapter\QueryAdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;

class Between implements QueryExpressionInterface
{
    protected $field;
    protected $start;
    protected $end;
    
    public function __construct($_field, $_start, $_end)
    {
        $this->field = $_field instanceof QueryExpressionInterface ? $_field : Column::from($_field);
        $this->start = $_start;
        $this->end = $_end;
    }
    
    public function buildOnQuery(QueryBuilderInterface $_qb, QueryAdapterInterface $_adapter): string
    {
        $field = $this->field->buildOnQuery($_qb, $_adapter);
        $between = array('start' => $this->start, 'end' => $this->end);
        foreach ($between as $index => $value) {
            if($value instanceof QueryExpressionInterface){
                $between[$index] = $value->buildOnQuery($_qb, $_adapter);
            }
            else{
                $between[$index] = $_qb->addParam($value);
            }
            
        }
        return "{$field} BETWEEN {$between['start']} AND {$between['end']}";
    }
}