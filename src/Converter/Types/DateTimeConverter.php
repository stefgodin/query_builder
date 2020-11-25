<?php


namespace Stefmachine\QueryBuilder\Converter\Types;


use Stefmachine\QueryBuilder\Adapter\QueryAdapterInterface;
use Stefmachine\QueryBuilder\Converter\TypeConverterInterface;

class DateTimeConverter implements TypeConverterInterface
{
    public static function canConvert($_value): bool
    {
        return $_value instanceof \DateTimeInterface;
    }
    
    /**
     * @param \DateTimeInterface $_value
     * @param QueryAdapterInterface $_adapter
     * @return mixed
     */
    public static function convert($_value, QueryAdapterInterface $_adapter)
    {
        return $_value->format('Y-m-d H:i:s');
    }
}