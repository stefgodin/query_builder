<?php


namespace Stefmachine\QueryBuilder\Expressions;


use Stefmachine\QueryBuilder\Adapter\QueryAdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;

interface QueryExpressionInterface
{
    /**
     * Adds parameters to the query and at the same time returns the SQL to add
     *
     * @param QueryBuilderInterface $_qb
     * @param QueryAdapterInterface $_adapter
     * @return string
     */
    public function buildOnQuery(QueryBuilderInterface $_qb, QueryAdapterInterface $_adapter): string;
}