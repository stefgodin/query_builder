<?php


namespace Stefmachine\QueryBuilder\Converter\Types;


use Clyvanor\Persistence\Adapter\AdapterInterface;
use Stefmachine\QueryBuilder\Converter\TypeConverterInterface;

class BooleanConverter implements TypeConverterInterface
{
    public static function canConvert($_value): bool
    {
        return is_bool($_value);
    }
    
    public static function convert($_value, AdapterInterface $_adapter)
    {
        return intval($_value);
    }
}