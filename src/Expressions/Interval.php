<?php


namespace Stefmachine\QueryBuilder\Expressions;


use Stefmachine\QueryBuilder\Adapter\QueryAdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;

class Interval implements QueryExpressionInterface
{
    protected $expression;
    protected $unit;
    
    public function __construct($_expression, string $_unit)
    {
        $this->expression = $_expression;
        $this->unit = $_unit;
    }
    
    public static function from($_expression, string $_unit)
    {
        return new static($_expression, $_unit);
    }
    
    private function getIntervalUnits(QueryAdapterInterface $_adapter): array
    {
        if($_adapter->getDriverName() !== 'mysql'){
            throw new \RuntimeException("Interval does not exist for driver");
        }
        
        /**
         * According to
         * @link https://dev.mysql.com/doc/refman/8.0/en/expressions.html#temporal-intervals
         */
        return array(
            'MICROSECOND', 'SECOND', 'MINUTE', 'HOUR', 'DAY', 'WEEK', 'MONTH', 'QUARTER', 'YEAR',
            'SECOND_MICROSECOND', 'MINUTE_MICROSECOND', 'MINUTE_SECOND', 'HOUR_MICROSECOND', 'HOUR_SECOND',
            'HOUR_MINUTE', 'DAY_MICROSECOND', 'DAY_SECOND', 'DAY_MINUTE', 'DAY_HOUR', 'YEAR_MONTH'
        );
    }
    
    public function buildOnQuery(QueryBuilderInterface $_qb, QueryAdapterInterface $_adapter): string
    {
        if(is_string($this->unit) && !in_array(strtoupper($this->unit), $this->getIntervalUnits($_adapter))){
            throw new \RuntimeException('Invalid unit given.');
        }
        
        if($this->expression instanceof QueryExpressionInterface){
            $expr = $this->expression->buildOnQuery($_qb, $_adapter);
            $expr = "($expr)";
        }
        else{
            $expr = $_qb->addParam($this->expression);
        }
        $unit = strtoupper($this->unit);
        return "INTERVAL {$expr} {$unit}";
    }
}