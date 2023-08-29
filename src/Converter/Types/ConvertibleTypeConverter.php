<?php


namespace Stefmachine\QueryBuilder\Converter\Types;

use Stefmachine\QueryBuilder\Adapter\QueryAdapterInterface;
use Stefmachine\QueryBuilder\Converter\ConvertibleTypeInterface;
use Stefmachine\QueryBuilder\Converter\TypeConverterInterface;

class ConvertibleTypeConverter implements TypeConverterInterface
{
    public static function canConvert($_value): bool
    {
        return gettype($_value) === 'object' && $_value instanceof ConvertibleTypeInterface;
    }
    
    /**
     * @param ConvertibleTypeInterface $_value
     * @param QueryAdapterInterface $_adapter
     * @return mixed
     */
    public static function convert($_value, QueryAdapterInterface $_adapter)
    {
        return $_value->convert($_adapter);
    }
}