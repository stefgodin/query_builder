<?php


namespace Stefmachine\QueryBuilder\Adapter;


interface AdapterInterface
{
    public function getDriverName(): string;
    
    /**
     * Transform a string into an identifier
     *
     * Ex1: column => `column`
     * Ex2: table.column => `table`.`column`
     *
     * @param string $_name
     * @return string
     */
    public function asIdentifier(string $_name): string;
    
    /**
     * Tells if the adapter allows reusing parameters within a request
     *
     * @return bool
     */
    public function allowsParametersOptimization(): bool;
}