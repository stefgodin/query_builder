<?php


namespace Stefmachine\QueryBuilder\Builder;


use Stefmachine\QueryBuilder\Adapter\QueryAdapterInterface;
use Stefmachine\QueryBuilder\Parts\TablePart;
use Stefmachine\QueryBuilder\Parts\WherePart;

class DeleteQueryBuilder extends BaseQueryBuilder
{
    protected function getTemplate(QueryAdapterInterface $_adapter): string
    {
        return 'DELETE FROM {TABLE} {WHERE}';
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
}