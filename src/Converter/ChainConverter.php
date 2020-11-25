<?php


namespace Stefmachine\QueryBuilder\Converter;


use Stefmachine\QueryBuilder\Adapter\AdapterInterface;
use Stefmachine\QueryBuilder\Converter\Types\BooleanConverter;
use Stefmachine\QueryBuilder\Converter\Types\DateTimeConverter;
use Stefmachine\QueryBuilder\Converter\Types\PrimitiveConverter;

class ChainConverter implements TypeConverterInterface
{
    /**
     * An array of TypeConverterInterface class name
     * @var string[]
     */
    protected static $converters = array(
        DateTimeConverter::class,
        BooleanConverter::class,
        PrimitiveConverter::class
    );
    
    public static function canConvert($_value): bool
    {
        foreach (self::$converters as $converter){
            if(call_user_func([$converter, 'canConvert'], $_value)){
                return true;
            }
        }
        
        return false;
    }
    
    public static function convert($_value, AdapterInterface $_adapter)
    {
        foreach (self::$converters as $converter){
            if(call_user_func([$converter, 'canConvert'], $_value)){
                return call_user_func([$converter, 'convert'], $_value, $_adapter);
            }
        }
    
        $type = gettype($_value);
        throw new \RuntimeException(sprintf('Could not convert value of type %s.', $type === "object" ? get_class($_value) : $type ));
    }
}