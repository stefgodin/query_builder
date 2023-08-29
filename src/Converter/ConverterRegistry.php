<?php


namespace Stefmachine\QueryBuilder\Converter;


use Stefmachine\QueryBuilder\Adapter\QueryAdapterInterface;
use Stefmachine\QueryBuilder\Converter\Types\BooleanConverter;
use Stefmachine\QueryBuilder\Converter\Types\ConvertibleTypeConverter;
use Stefmachine\QueryBuilder\Converter\Types\DateTimeConverter;
use Stefmachine\QueryBuilder\Converter\Types\EnumConverter;
use Stefmachine\QueryBuilder\Converter\Types\PrimitiveConverter;

class ConverterRegistry implements TypeConverterInterface
{
    /**
     * An array of TypeConverterInterface class name
     * @var string[]|class-string<TypeConverterInterface>[]
     */
    protected static array $converters = array(
        PrimitiveConverter::class,
        BooleanConverter::class,
        DateTimeConverter::class,
        EnumConverter::class,
        ConvertibleTypeConverter::class
    );
    
    /**
     * @param string|class-string<TypeConverterInterface> $_converter
     * @return void
     */
    public static function register(string $_converter): void
    {
        static::$converters[] = $_converter;
    }
    
    public static function getConverters(): array
    {
        // We invert orders to give priority to newer converters
        return array_reverse(self::$converters);
    }
    
    public static function canConvert($_value): bool
    {
        foreach (self::getConverters() as $converter){
            if(call_user_func([$converter, 'canConvert'], $_value)){
                return true;
            }
        }
        
        return false;
    }
    
    public static function convert($_value, QueryAdapterInterface $_adapter)
    {
        foreach (self::getConverters() as $converter){
            if(call_user_func([$converter, 'canConvert'], $_value)){
                return call_user_func([$converter, 'convert'], $_value, $_adapter);
            }
        }
    
        $type = gettype($_value);
        throw new \RuntimeException(sprintf('Could not convert value of type %s.', $type === "object" ? get_class($_value) : $type));
    }
}