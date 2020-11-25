<?php


namespace Stefmachine\QueryBuilder\Builder;


use Stefmachine\QueryBuilder\Adapter\AdapterInterface;
use Stefmachine\QueryBuilder\Expressions\Join;
use Stefmachine\QueryBuilder\Expressions\QueryExpressionInterface;
use Stefmachine\QueryBuilder\Parts\GroupByPart;
use Stefmachine\QueryBuilder\Parts\HavingPart;
use Stefmachine\QueryBuilder\Parts\JoinedTablesPart;
use Stefmachine\QueryBuilder\Parts\LimitOffsetPart;
use Stefmachine\QueryBuilder\Parts\OrderByPart;
use Stefmachine\QueryBuilder\Parts\QueryPartInterface;
use Stefmachine\QueryBuilder\Parts\SelectColumnsPart;
use Stefmachine\QueryBuilder\Parts\TablePart;
use Stefmachine\QueryBuilder\Parts\UnionPart;
use Stefmachine\QueryBuilder\Parts\WherePart;

class SelectQueryBuilder extends BaseQueryBuilder
{
    protected function canWrapOnBuild(): bool
    {
        return true;
    }
    
    protected function getTemplate(AdapterInterface $_adapter): string
    {
        return 'SELECT {DISTINCT} {COLUMNS} FROM {TABLE} {JOIN} {WHERE} {GROUP_BY} {HAVING} {ORDER_BY} {UNION} {UNION_ALL} {LIMIT}';
    }
    
    public static function create(array $_fields = array())
    {
        $query = new static();
        $query->select($_fields);
        return $query;
    }
    
    public function select(array $_fields = array())
    {
        $this->setPart('COLUMNS', SelectColumnsPart::from($_fields));
        return $this;
    }
    
    public function distinct()
    {
        $this->setPart('DISTINCT', new class() implements QueryPartInterface {
            public function buildOnQuery(QueryBuilderInterface $_qb, AdapterInterface $_adapter): string
            {
                return 'DISTINCT';
            }
        });
        return $this;
    }
    
    public function from($_table, ?string $_alias = null)
    {
        $this->setPart('TABLE', TablePart::from($_table, $_alias));
        return $this;
    }
    
    private function joinPart(): JoinedTablesPart
    {
        $part = $this->getPart('JOIN');
        if(!$part instanceof JoinedTablesPart){
            $part = JoinedTablesPart::from();
            $this->setPart('JOIN', $part);
        }
        return $part;
    }
    
    public function innerJoin($_table, string $_alias = null, array $_criteria = array())
    {
        $this->joinPart()->addJoin(Join::inner($_table, $_alias, $_criteria));
        return $this;
    }
    
    public function leftJoin($_table, string $_alias = null, array $_criteria = array())
    {
        $this->joinPart()->addJoin(Join::left($_table, $_alias, $_criteria));
        return $this;
    }
    
    public function rightJoin($_table, string $_alias = null, array $_criteria = array())
    {
        $this->joinPart()->addJoin(Join::right($_table, $_alias, $_criteria));
        return $this;
    }
    
    public function where(array $_criteria)
    {
        $this->setPart('WHERE', WherePart::from($_criteria));
        return $this;
    }
    
    private function orderByPart(): OrderByPart
    {
        $part = $this->getPart('ORDER_BY');
        if(!$part instanceof OrderByPart){
            $part = OrderByPart::from();
            $this->setPart('ORDER_BY', $part);
        }
        return $part;
    }
    
    public function orderBy($_orderBy)
    {
        if($_orderBy !== null) {
            if(!is_array($_orderBy)){
                $_orderBy = [$_orderBy];
            }
        }
        else{
            $_orderBy = array();
        }
        
        foreach ($_orderBy as $field => $direction){
            if(is_int($field)){
                $field = $direction;
                $direction = "ASC";
            }
            
            if(is_string($field) && in_array(strtoupper($field), ['ASC', 'DESC']) && $direction instanceof QueryExpressionInterface){
                //fixme: this should not work like that because it only allows one DESC field with query expressions
                $fieldBuffer = $field;
                $field = $direction;
                $direction = $fieldBuffer;
            }
    
            $this->addOrderBy($field, $direction);
        }
        
        return $this;
    }
    
    public function addOrderBy($_field, string $_direction = 'ASC')
    {
        $this->orderByPart()->add($_field, $_direction);
        return $this;
    }
    
    private function limitPart(): LimitOffsetPart
    {
        $part = $this->getPart('LIMIT');
        if(!$part instanceof LimitOffsetPart){
            $part = LimitOffsetPart::from();
            $this->setPart('LIMIT', $part);
        }
        return $part;
    }
    
    public function limit(?int $_limit)
    {
        $this->limitPart()->setLimit($_limit);
        return $this;
    }
    
    public function offset(?int $_offset)
    {
        $this->limitPart()->setOffset($_offset);
        return $this;
    }
    
    /**
     * @deprecated Use separate methods ->limit() and ->offset()
     *
     * @param int|null $_offset
     * @param int|null $_limit
     * @return $this
     */
    public function limitOffset(int $_offset = null, int $_limit = null)
    {
        $this->limit($_limit)
            ->offset($_offset);
        return $this;
    }
    
    public function groupBy(...$_columns)
    {
        $this->setPart('GROUP_BY', GroupByPart::from(...$_columns));
        return $this;
    }
    
    public function having(array $_criteria)
    {
        $this->setPart('HAVING', HavingPart::from($_criteria));
        return $this;
    }
    
    public function union(QueryExpressionInterface ...$_query)
    {
        $this->setPart('UNION', UnionPart::from(false, ...$_query));
        return $this;
    }
    
    public function unionAll(QueryExpressionInterface ...$_query)
    {
        $this->setPart('UNION_ALL', UnionPart::from(true, ...$_query));
        return $this;
    }
}