<?php


namespace Stefmachine\QueryBuilder\Builder;


use Stefmachine\QueryBuilder\Adapter\AdapterInterface;
use Stefmachine\QueryBuilder\Parts\QueryPartInterface;
use Stefmachine\QueryBuilder\QueryInterface;

interface QueryBuilderInterface
{
    /**
     * Adds a parameter to the query and returns the new parameter name
     *
     * @param $_value
     * @return string
     */
    public function addParam($_value): string;
    
    public function getQuery(AdapterInterface $_adapter): QueryInterface;
}