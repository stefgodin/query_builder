<?php


namespace Stefmachine\QueryBuilder\Builder;


use Stefmachine\QueryBuilder\Adapter\AdapterInterface;
use Stefmachine\QueryBuilder\Parts\TablePart;
use Stefmachine\QueryBuilder\Parts\WherePart;

class DeleteQueryBuilder extends BaseQueryBuilder
{
    protected function getTemplate(AdapterInterface $_adapter): string
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