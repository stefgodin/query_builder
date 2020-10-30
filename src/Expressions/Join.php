<?php


namespace Stefmachine\QueryBuilder\Expressions;


use Clyvanor\Persistence\Adapter\AdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;

class Join
{
    const INNER = 'INNER';
    const LEFT = 'LEFT';
    const RIGHT = 'RIGHT';
    
    protected $table;
    protected $criteria;
    protected $joinType;
    
    public function __construct($_name, string $_alias = null, array $_criteria = array(), string $_type = self::INNER)
    {
        if(!$_name instanceof Table && !$_name instanceof Alias){
            $this->table = Table::from($_name);
            if($_alias !== null){
                $this->table = Alias::from($this->table, $_alias);
            }
        }
        else{
            $this->table = $_name;
        }
        $this->joinType = $_type;
    
        $this->criteria = array_map(function($_value, $_field){
            if($_value instanceof QueryExpressionInterface){
                if(is_int($_field)){
                    return $_value;
                }
            }
            else if(is_string($_value)){
                $_value = Column::from($_value);
            }
        
            return Expr::smartEquals(Column::from($_field), $_value);
        }, $_criteria, array_keys($_criteria));
    }
    
    public static function from($_table, string $_alias = null, array $_criteria = array(), string $_type = self::INNER)
    {
        return new static($_table, $_alias, $_criteria, $_type);
    }
    
    public static function inner($_table, string $_alias = null, array $_criteria = array())
    {
        return new static($_table, $_alias, $_criteria, self::INNER);
    }
    
    public static function left($_table, string $_alias = null, array $_criteria = array())
    {
        return new static($_table, $_alias, $_criteria, self::LEFT);
    }
    
    public static function right($_table, string $_alias = null, array $_criteria = array())
    {
        return new static($_table, $_alias, $_criteria, self::RIGHT);
    }
    
    public function buildOnQuery(QueryBuilderInterface $_qb, AdapterInterface $_adapter): string
    {
        $table = $this->table->buildOnQuery($_qb, $_adapter);
    
        if(!empty($this->criteria)){
            $conditions = Expr::AndX(...$this->criteria)->buildOnQuery($_qb, $_adapter);
            $conditions = "ON {$conditions}";
        }
        else{
            $conditions = "";
        }
        
        return "{$this->joinType} JOIN {$table} {$conditions}";
    }
}