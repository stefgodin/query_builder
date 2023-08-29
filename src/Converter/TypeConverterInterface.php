<?php


namespace Stefmachine\QueryBuilder\Converter;


use Stefmachine\QueryBuilder\Adapter\QueryAdapterInterface;

interface TypeConverterInterface
{
    /**
     * @param mixed $_value
     * @return bool
     */
    public static function canConvert($_value): bool;
    
    /**
     * @param mixed $_value
     * @param QueryAdapterInterface $_adapter
     * @return mixed
     */
    public static function convert($_value, QueryAdapterInterface $_adapter);
}