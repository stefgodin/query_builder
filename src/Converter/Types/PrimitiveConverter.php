<?php


namespace Stefmachine\QueryBuilder\Converter\Types;


use Clyvanor\Persistence\Adapter\AdapterInterface;
use Stefmachine\QueryBuilder\Converter\TypeConverterInterface;

class PrimitiveConverter implements TypeConverterInterface
{
    public static function canConvert($_value): bool
    {
        return in_array(gettype($_value), ['integer', 'double', 'string', 'NULL']);
    }
    
    public static function convert($_value, AdapterInterface $_adapter)
    {
        return $_value;
    }
}