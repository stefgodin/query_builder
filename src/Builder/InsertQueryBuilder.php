<?php


namespace Stefmachine\QueryBuilder\Builder;


use Clyvanor\Persistence\Adapter\AdapterInterface;
use Stefmachine\QueryBuilder\Parts\InsertColumnsPart;
use Stefmachine\QueryBuilder\Parts\InsertValuesPart;
use Stefmachine\QueryBuilder\Parts\TablePart;

class InsertQueryBuilder extends BaseQueryBuilder
{
    protected function getTemplate(AdapterInterface $_adapter): string
    {
        return 'INSERT INTO {TABLE}{COLUMNS} VALUES {VALUES}';
    }
    
    public function into($_table, ?string $_alias = null)
    {
        $this->setPart('TABLE', TablePart::from($_table, $_alias));
        return $this;
    }
    
    public function values(array $_data)
    {
        $first = reset($_data);
        if(!is_array($first)){
            $first = $_data;
            $_data = [$_data];
        }
        
        $this->setPart('COLUMNS', InsertColumnsPart::from(array_keys($first)));
        $this->setPart('VALUES', InsertValuesPart::from($_data));
        return $this;
    }
}