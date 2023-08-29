<?php


namespace Stefmachine\QueryBuilder\Converter\Types;

use Stefmachine\QueryBuilder\Adapter\QueryAdapterInterface;
use Stefmachine\QueryBuilder\Converter\TypeConverterInterface;

class EnumConverter implements TypeConverterInterface
{
    public static function canConvert($_value): bool
    {
        return gettype($_value) === 'object'
            && version_compare(PHP_VERSION, '8.1.0', '>=')
            && enum_exists(get_class($_value));
    }
    
    /**
     * @param \UnitEnum $_value
     * @param QueryAdapterInterface $_adapter
     * @return int|mixed|string
     */
    public static function convert($_value, QueryAdapterInterface $_adapter)
    {
        if(!version_compare(PHP_VERSION, '8.1.0', '>=')){
            throw new \RuntimeException(sprintf('Cannot use %s under php 8.1.0', __METHOD__));
        }
        
        
        if($_value instanceof \BackedEnum){
            return $_value->value;
        }
        
        return $_value->name;
    }
}