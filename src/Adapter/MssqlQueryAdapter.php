<?php


namespace Stefmachine\QueryBuilder\Adapter;


class MssqlQueryAdapter implements QueryAdapterInterface
{
    public function getDriverName(): string
    {
        return 'mssql';
    }
    
    public function asIdentifier(string $_name): string
    {
        $identifierParts = explode('.', $_name);
        $identifierParts = array_map(function(string $_part){
            return "[{$_part}]";
        }, $identifierParts);
        return implode('.', $identifierParts);
    }
    
    public function allowsParametersOptimization(): bool
    {
        return false;
    }
}