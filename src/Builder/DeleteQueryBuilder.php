<?php


namespace Stefmachine\QueryBuilder\Builder;

use Stefmachine\QueryBuilder\Adapter\QueryAdapterInterface;
use Stefmachine\QueryBuilder\Parts\LimitOffsetPart;
use Stefmachine\QueryBuilder\Parts\OrderByPart;
use Stefmachine\QueryBuilder\Parts\TablePart;
use Stefmachine\QueryBuilder\Parts\WherePart;

class DeleteQueryBuilder extends BaseQueryBuilder
{
    protected function getTemplate(QueryAdapterInterface $_adapter): string
    {
        return 'DELETE FROM {TABLE} {WHERE} {ORDER_BY} {LIMIT}';
    }
    
    public function from($_table, ?string $_alias = null)
    {
        $this->setPart('TABLE', TablePart::from($_table, $_alias));
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