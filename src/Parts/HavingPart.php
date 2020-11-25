<?php


namespace Stefmachine\QueryBuilder\Parts;


use Stefmachine\QueryBuilder\Adapter\QueryAdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;
use Stefmachine\QueryBuilder\Expressions\Column;
use Stefmachine\QueryBuilder\Expressions\Expr;
use Stefmachine\QueryBuilder\Expressions\QueryExpressionInterface;

class HavingPart implements QueryPartInterface
{
    /** @var QueryExpressionInterface[] */
    protected $parts;
    
    public function __construct(array $_whereParts)
    {
        $this->parts = array_map(function($_value, $_field){
            if(is_int($_field) && $_value instanceof QueryExpressionInterface){
                return $_value;
            }
            
            return Expr::smartEquals(Column::from($_field), $_value);
        }, $_whereParts, array_keys($_whereParts));
    }
    
    public static function from(array $_havingParts)
    {
        return new static($_havingParts);
    }
    
    public function buildOnQuery(QueryBuilderInterface $_qb, QueryAdapterInterface $_adapter): string
    {
        if(!empty($this->parts)){
            $conditions = Expr::AndX(...$this->parts)->buildOnQuery($_qb, $_adapter);
            $conditions = "HAVING {$conditions}";
        }
        else{
            $conditions = "";
        }
        
        return $conditions;
    }
}