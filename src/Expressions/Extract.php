<?php


namespace Stefmachine\QueryBuilder\Expressions;

use Stefmachine\QueryBuilder\Adapter\QueryAdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;

class Extract implements QueryExpressionInterface
{
    protected string $part;
    protected $date;
    
    public function __construct(string $_part, $_date)
    {
        $this->part = $_part;
        $this->date = $_date;
    }
    
    public static function from($_expression, string $_dataType)
    {
        return new static($_expression, $_dataType);
    }
    
    public function buildOnQuery(QueryBuilderInterface $_qb, QueryAdapterInterface $_adapter): string
    {
        if($_adapter->getDriverName() !== 'mysql') {
            throw new \RuntimeException("EXTRACT does not exist for driver '{$_adapter->getDriverName()}'");
        }
        
        $parts = [
            'MICROSECOND', 'SECOND', 'MINUTE', 'HOUR', 'DAY', 'WEEK', 'MONTH', 'QUARTER', 'YEAR',
            'SECOND_MICROSECOND', 'MINUTE_MICROSECOND', 'MINUTE_SECOND', 'HOUR_MICROSECOND', 'HOUR_SECOND',
            'HOUR_MINUTE', 'DAY_MICROSECOND', 'DAY_SECOND', 'DAY_MINUTE', 'DAY_HOUR', 'YEAR_MONTH',
        ];
        
        $part = strtoupper($this->part);
        if(!in_array($part, $parts)) {
            throw new \RuntimeException("Invalid part '{$this->part}' given.");
        }
        
        if($this->date instanceof QueryExpressionInterface) {
            $expr = $this->date->buildOnQuery($_qb, $_adapter);
            $expr = "($expr)";
        } else {
            $expr = $_qb->addParam($this->date);
        }
        return "EXTRACT({$part} FROM {$expr})";
    }
}