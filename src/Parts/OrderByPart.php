<?php


namespace Stefmachine\QueryBuilder\Parts;



use Stefmachine\QueryBuilder\Expressions\Column;
use Stefmachine\QueryBuilder\Expressions\QueryExpressionInterface;
use Stefmachine\QueryBuilder\Adapter\QueryAdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;
use Stefmachine\QueryBuilder\Parts\SubPart\OrderSubPart;

class OrderByPart implements QueryPartInterface
{
    /** @var OrderSubPart[] */
    protected $orderBy;
    
    public function __construct()
    {
        $this->orderBy = array();
    }
    
    public static function from()
    {
        return new static();
    }
    
    public function add($_field, string $_direction)
    {
        $_direction = strtoupper($_direction);
        if(!in_array($_direction, ["ASC", "DESC"])){
            throw new \LogicException("Expected OrderBy direction to be 'ASC' or 'DESC', '{$_direction}' given.");
        }
    
        $this->orderBy[] = new OrderSubPart($_field, $_direction === 'ASC');
    }
    
    public function buildOnQuery(QueryBuilderInterface $_qb, QueryAdapterInterface $_adapter): string
    {
        $orderBy = array();
        if($this->orderBy !== null){
            foreach ($this->orderBy as $order){
                $field = $order->getField();
                $field = $field instanceof QueryExpressionInterface ? $field : Column::from($field);
                $field = $field->buildOnQuery($_qb, $_adapter);
                
                $direction = $order->isAscending() ? 'ASC' : 'DESC';
                
                $orderBy[] = "{$field} {$direction}";
            }
        }
        $orderBy = implode(', ', $orderBy);
        if($orderBy != ""){
            $orderBy = "ORDER BY {$orderBy}";
        }
        
        return $orderBy;
    }
}