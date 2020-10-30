<?php


namespace Stefmachine\QueryBuilder;


use Clyvanor\Persistence\Adapter\AdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;
use Stefmachine\QueryBuilder\Builder\SelectQueryBuilder;
use Stefmachine\QueryBuilder\Expressions\Alias;
use Stefmachine\QueryBuilder\Expressions\QueryExpressionInterface;
use Stefmachine\QueryBuilder\Parts\QueryPartInterface;

abstract class QueryBuilderProxy implements QueryBuilderInterface, QueryPartInterface
{
    private $name;
    private $qb;
    
    public function __construct(?string $_as = null)
    {
        $this->name = $_as;
        $this->qb = $this->buildQuery();
    }
    
    public static function as(string $_name)
    {
        return new static($_name);
    }
    
    public static function get()
    {
        return new static();
    }
    
    abstract protected function buildQuery(): SelectQueryBuilder;
    
    public function addParam($_value): string
    {
        return $this->qb->addParam($_value);
    }
    
    public function getQuery(AdapterInterface $_adapter): QueryInterface
    {
        return $this->qb->getQuery($_adapter);
    }
    
    public function buildOnQuery(QueryBuilderInterface $_qb, AdapterInterface $_adapter): string
    {
        $expr = $this->name !== null ? new Alias($this->qb, $this->name) : $this->qb;
        return $expr->buildOnQuery($_qb, $_adapter);
    }
    
    
    /**
     * The following methods are protected, but if you want the user to be able to use them,
     * make them public individually in subclass
     */
    
    protected function select(array $_fields = array())
    {
        $this->qb->select($_fields);
        return $this;
    }
    
    protected function distinct()
    {
        $this->qb->distinct();
        return $this;
    }
    
    protected function from($_table, ?string $_alias = null)
    {
        $this->qb->from($_table, $_alias);
        return $this;
    }
    
    protected function innerJoin($_table, string $_alias = null, array $_criteria = array())
    {
        $this->qb->innerJoin($_table, $_alias, $_criteria);
        return $this;
    }
    
    protected function leftJoin($_table, string $_alias = null, array $_criteria = array())
    {
        $this->qb->leftJoin($_table, $_alias, $_criteria);
        return $this;
    }
    
    protected function rightJoin($_table, string $_alias = null, array $_criteria = array())
    {
        $this->qb->rightJoin($_table, $_alias, $_criteria);
        return $this;
    }
    
    protected function where(array $_criteria)
    {
        $this->qb->where($_criteria);
        return $this;
    }
    
    protected function orderBy($_orderBy)
    {
        $this->qb->orderBy($_orderBy);
        return $this;
    }
    
    protected function addOrderBy($_field, string $_direction = 'ASC')
    {
        $this->qb->addOrderBy($_field, $_direction);
        return $this;
    }
    
    protected function limit(?int $_limit)
    {
        $this->qb->limit($_limit);
        return $this;
    }
    
    protected function offset(?int $_offset)
    {
        $this->offset($_offset);
        return $this;
    }
    
    protected function groupBy(...$_columns)
    {
        $this->qb->groupBy(...$_columns);
        return $this;
    }
    
    protected function having(array $_criteria)
    {
        $this->qb->having($_criteria);
        return $this;
    }
    
    protected function union(QueryExpressionInterface ...$_query)
    {
        $this->qb->union(...$_query);
        return $this;
    }
    
    protected function unionAll(QueryExpressionInterface ...$_query)
    {
        $this->qb->unionAll(...$_query);
        return $this;
    }
}