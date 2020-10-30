<?php


namespace Stefmachine\QueryBuilder\Expressions;

use Clyvanor\Persistence\Adapter\AdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;

class Cast implements QueryExpressionInterface
{
    protected $expression;
    protected $dataType;
    
    public function __construct($_expression, string $_dataType)
    {
        $this->expression = $_expression;
        $this->dataType = $_dataType;
    }
    
    public static function from($_expression, string $_dataType)
    {
        return new static($_expression, $_dataType);
    }
    
    private function getDataTypes(AdapterInterface $_adapter): array
    {
        if($_adapter->getDriverName() == 'mysql'){
            return array('DATE', 'DATETIME', 'TIME', 'CHAR', 'SIGNED', 'UNSIGNED', 'BINARY');
        }
        
        if($_adapter->getDriverName() == 'mssql'){
            return array(
                'bigint', 'int', 'smallint', 'tinyint', 'bit', 'decimal', 'numeric', 'money', 'smallmoney', 'float',
                'real', 'datetime', 'smalldatetime', 'char', 'varchar', 'text', 'nchar', 'nvarchar', 'ntext', 'binary',
                'varbinary', 'image'
            );
        }
    
        throw new \RuntimeException("Cast does not exist for driver");
    }
    
    public function buildOnQuery(QueryBuilderInterface $_qb, AdapterInterface $_adapter): string
    {
        if(is_string($this->dataType) && !in_array(strtoupper($this->dataType), $this->getDataTypes($_adapter))){
            throw new \RuntimeException('Invalid unit given.');
        }
        
        if($this->expression instanceof QueryExpressionInterface){
            $expr = $this->expression->buildOnQuery($_qb, $_adapter);
            $expr = "($expr)";
        }
        else{
            $expr = $_qb->addParam($this->expression);
        }
        $dataType = strtoupper($this->dataType);
        return "CAST({$expr} AS {$dataType})";
    }
}