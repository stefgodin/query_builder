<?php


namespace Stefmachine\QueryBuilder;


interface QueryInterface
{
    public function getParameters(): array;
    
    public function getSql(): string;
}