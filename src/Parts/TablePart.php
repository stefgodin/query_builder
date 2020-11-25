<?php


namespace Stefmachine\QueryBuilder\Parts;



use Stefmachine\QueryBuilder\Expressions\Alias;
use Stefmachine\QueryBuilder\Expressions\QueryExpressionInterface;
use Stefmachine\QueryBuilder\Adapter\QueryAdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;
use Stefmachine\QueryBuilder\Expressions\Table;

class TablePart implements QueryPartInterface
{
    /** @var Table */
    protected $table;
    
    public function __construct($_table, ?string $_alias = null)
    {
        if(!($_table instanceof Table || $_table instanceof Alias) && (is_string($_table) || $_table instanceof QueryExpressionInterface)){
            $_table = Table::from($_table);
            if($_alias !== null){
                $_table = Alias::from($_table, $_alias);
            }
        }
        
        $this->table = $_table;
    }
    
    public static function from($_table, ?string $_alias = null)
    {
        return new static($_table, $_alias);
    }
    
    public function buildOnQuery(QueryBuilderInterface $_qb, QueryAdapterInterface $_adapter): string
    {
        return $this->table->buildOnQuery($_qb, $_adapter);
    }
}