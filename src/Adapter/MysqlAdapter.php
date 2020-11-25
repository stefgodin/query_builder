<?php


namespace Stefmachine\QueryBuilder\Adapter;


class MysqlAdapter implements AdapterInterface
{
    public function getDriverName(): string
    {
        return 'mysql';
    }
    
    public function asIdentifier(string $_name): string
    {
        $identifierParts = explode('.', $_name);
        $identifierParts = array_map(function(string $_part){
            return "`{$_part}`";
        }, $identifierParts);
        return implode('.', $identifierParts);
    }
    
    public function allowsParametersOptimization(): bool
    {
        return true;
    }
}