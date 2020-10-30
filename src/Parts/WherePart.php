<?php


namespace Stefmachine\QueryBuilder\Parts;


use Stefmachine\QueryBuilder\Expressions\Column;
use Stefmachine\QueryBuilder\Expressions\Expr;
use Stefmachine\QueryBuilder\Expressions\QueryExpressionInterface;

use Clyvanor\Persistence\Adapter\AdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;

class WherePart implements QueryPartInterface
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
    
    public static function from(array $_whereParts)
    {
        return new static($_whereParts);
    }
    
    public function buildOnQuery(QueryBuilderInterface $_qb, AdapterInterface $_adapter): string
    {
        if(!empty($this->parts)){
            $conditions = Expr::AndX(...$this->parts)->buildOnQuery($_qb, $_adapter);
            $conditions = "WHERE {$conditions}";
        }
        else{
            $conditions = "";
        }
        
        return $conditions;
    }
}