<?php


namespace Stefmachine\QueryBuilder\Builder;


use Stefmachine\QueryBuilder\Adapter\AdapterInterface;
use Stefmachine\QueryBuilder\Parts\QueryPartInterface;

class ChainQueryBuilder extends BaseQueryBuilder
{
    protected function getTemplate(AdapterInterface $_adapter): string
    {
        if($this->getQueryCount() > 0){
            return implode('; ', array_map(function($_number){
                return "{QUERY_{$_number}}";
            }, range(1, $this->getQueryCount())));
        }
    
        return "";
    }
    
    public function addQuery(QueryPartInterface $_query)
    {
        $newQueryNumber = $this->getQueryCount() + 1;
        $this->setPart("QUERY_{$newQueryNumber}", $_query);
        return $this;
    }
    
    public function getQueryCount(): int
    {
        return count($this->queryParts);
    }
}