<?php


namespace Stefmachine\QueryBuilder\Converter;

use Stefmachine\QueryBuilder\Adapter\QueryAdapterInterface;

interface ConvertibleTypeInterface
{
    public function convert(QueryAdapterInterface $_adapter);
}