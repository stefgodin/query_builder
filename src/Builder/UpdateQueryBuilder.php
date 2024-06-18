<?php


namespace Stefmachine\QueryBuilder\Builder;

use Stefmachine\QueryBuilder\Adapter\QueryAdapterInterface;
use Stefmachine\QueryBuilder\Expressions\Join;
use Stefmachine\QueryBuilder\Parts\JoinedTablesPart;
use Stefmachine\QueryBuilder\Parts\LimitOffsetPart;
use Stefmachine\QueryBuilder\Parts\OrderByPart;
use Stefmachine\QueryBuilder\Parts\TablePart;
use Stefmachine\QueryBuilder\Parts\UpdateValuesPart;
use Stefmachine\QueryBuilder\Parts\WherePart;

class UpdateQueryBuilder extends BaseQueryBuilder
{
    protected function getTemplate(QueryAdapterInterface $_adapter): string
    {
        return 'UPDATE {TABLE} {JOIN} SET {VALUES} {WHERE} {ORDER_BY} {LIMIT}';
    }
    
    public function table($_table, ?string $_alias = null)
    {
        $this->setPart('TABLE', TablePart::from($_table, $_alias));
        return $this;
    }
    
    private function initJoinPart(): JoinedTablesPart
    {
        $part = $this->getPart('JOIN');
        if(!$part instanceof JoinedTablesPart) {
            $part = JoinedTablesPart::from();
            $this->setPart('JOIN', $part);
        }
        return $part;
    }
    
    public function innerJoin($_table, string $_alias = null, array $_criteria = [])
    {
        $this->initJoinPart()->addJoin(Join::inner($_table, $_alias, $_criteria));
        return $this;
    }
    
    public function leftJoin($_table, string $_alias = null, array $_criteria = [])
    {
        $this->initJoinPart()->addJoin(Join::left($_table, $_alias, $_criteria));
        return $this;
    }
    
    public function set(array $_data)
    {
        $this->setPart('VALUES', UpdateValuesPart::from($_data));
        return $this;
    }
    
    public function where(array $_criteria)
    {
        $this->setPart('WHERE', WherePart::from($_criteria));
        return $this;
    }
    
    public function addOrderBy($_field, string $_direction = 'ASC')
    {
        $part = $this->getPart('ORDER_BY');
        if(!$part instanceof OrderByPart) {
            $part = OrderByPart::from();
            $this->setPart('ORDER_BY', $part);
        }
        $part->add($_field, $_direction);
        return $this;
    }
    
    public function limit(?int $_limit)
    {
        $part = $this->getPart('LIMIT');
        if(!$part instanceof LimitOffsetPart) {
            $part = LimitOffsetPart::from();
            $this->setPart('LIMIT', $part);
        }
        $part->setLimit($_limit);
        return $this;
    }
}