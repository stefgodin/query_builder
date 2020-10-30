<?php


namespace Stefmachine\QueryBuilder;

use Stefmachine\QueryBuilder\Builder\ChainQueryBuilder;
use Stefmachine\QueryBuilder\Builder\DeleteQueryBuilder;
use Stefmachine\QueryBuilder\Builder\InsertQueryBuilder;
use Stefmachine\QueryBuilder\Builder\SelectQueryBuilder;
use Stefmachine\QueryBuilder\Builder\StoredProcQueryBuilder;
use Stefmachine\QueryBuilder\Builder\UpdateQueryBuilder;

class QueryBuilder
{
    public static function select(array $_fields = []): SelectQueryBuilder
    {
        return SelectQueryBuilder::create($_fields);
    }
    
    public static function update(): UpdateQueryBuilder
    {
        return UpdateQueryBuilder::create();
    }
    
    public static function insert(): InsertQueryBuilder
    {
        return InsertQueryBuilder::create();
    }
    
    public static function delete(): DeleteQueryBuilder
    {
        return DeleteQueryBuilder::create();
    }
    
    public static function multiQuery(): ChainQueryBuilder
    {
        return ChainQueryBuilder::create();
    }
    
    public static function call(?string $_storedProc = null, array $_params = array()): StoredProcQueryBuilder
    {
        return StoredProcQueryBuilder::create($_storedProc, $_params);
    }
}