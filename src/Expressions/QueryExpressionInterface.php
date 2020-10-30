<?php


namespace Stefmachine\QueryBuilder\Expressions;


use Clyvanor\Persistence\Adapter\AdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;

interface QueryExpressionInterface
{
    /**
     * Adds parameters to the query and at the same time returns the SQL to add
     *
     * @param QueryBuilderInterface $_qb
     * @return string
     */
    public function buildOnQuery(QueryBuilderInterface $_qb, AdapterInterface $_adapter): string;
}