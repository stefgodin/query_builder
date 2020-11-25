<?php


namespace Stefmachine\QueryBuilder\Converter;


use Stefmachine\QueryBuilder\Adapter\AdapterInterface;

interface TypeConverterInterface
{
    public static function canConvert($_value): bool;
    
    public static function convert($_value, AdapterInterface $_adapter);
}