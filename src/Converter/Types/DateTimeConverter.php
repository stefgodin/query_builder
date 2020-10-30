<?php


namespace Stefmachine\QueryBuilder\Converter\Types;


use Clyvanor\Persistence\Adapter\AdapterInterface;
use Stefmachine\QueryBuilder\Converter\TypeConverterInterface;

class DateTimeConverter implements TypeConverterInterface
{
    public static function canConvert($_value): bool
    {
        return $_value instanceof \DateTimeInterface;
    }
    
    /**
     * @param \DateTimeInterface $_value
     * @param AdapterInterface $_adapter
     * @return mixed
     */
    public static function convert($_value, AdapterInterface $_adapter)
    {
        return $_value->format('Y-m-d H:i:s');
    }
}