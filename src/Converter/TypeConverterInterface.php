<?php


namespace Stefmachine\QueryBuilder\Converter;


use Stefmachine\QueryBuilder\Adapter\QueryAdapterInterface;

interface TypeConverterInterface
{
    public static function canConvert($_value): bool;
    
    public static function convert($_value, QueryAdapterInterface $_adapter);
}