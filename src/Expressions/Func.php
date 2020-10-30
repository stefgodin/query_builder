<?php


namespace Stefmachine\QueryBuilder\Expressions;


final class Func
{
    private function __construct(){}
    
    /** String functions */
    
    public static function ascii()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function charLength()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function characterLength()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function concat()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function concatWs()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function field()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function findInSet()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function format()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function insert()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function instr()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function lcase()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function left()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function length()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function locate()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function lower($_text)
    {
        return new FunctionExpression('LOWER', $_text);
    }
    
    public static function lpad($_text, $_padLength, $_padString)
    {
        return new FunctionExpression('LPAD', $_text, $_padLength, $_padString);
    }
    
    public static function ltrim()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function mid()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function position()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function repeat()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function replace($_subject, $_search, $_replace)
    {
        return new FunctionExpression('REPLACE', $_subject, $_search, $_replace);
    }
    
    public static function reverse()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function right()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function rpad()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function rtrim()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function space()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function strcmp()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function substr()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function substring()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function substringIndex($_text, $_delimiter, $_number)
    {
        return new FunctionExpression('SUBSTRING_INDEX', $_text, $_delimiter, $_number);
    }
    
    public static function trim($_value)
    {
        return new FunctionExpression('TRIM', $_value);
    }
    
    public static function ucase()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function upper($_text)
    {
        return new FunctionExpression('UPPER', $_text);
    }
    
    
    /** Numeric functions */
    
    public static function abs()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function acos()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function asin()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function atan()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function atan2()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function avg()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function ceil()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function ceiling()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function cos()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function cot()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function count($_column)
    {
        return new FunctionExpression('COUNT', $_column instanceof QueryExpressionInterface ? $_column : Column::from($_column));
    }
    
    public static function degrees()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function div()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function exp()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function floor()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function greatest()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function least()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function ln()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function log()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function log10()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function log2()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function max($_column)
    {
        return new FunctionExpression('MAX', $_column instanceof QueryExpressionInterface ? $_column : Column::from($_column));
    
    }
    
    public static function min($_column)
    {
        return new FunctionExpression('MIN', $_column instanceof QueryExpressionInterface ? $_column : Column::from($_column));
    }
    
    public static function mod()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function pi()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function pow()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function power()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function radians()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function rand()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function round($_value)
    {
        return new FunctionExpression('ROUND', $_value);
    }
    
    public static function sign()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function sin()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function sqrt()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function sum($_column)
    {
        return new FunctionExpression('SUM', $_column instanceof QueryExpressionInterface ? $_column : Column::from($_column));
    }
    
    public static function tan()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function truncate()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    /** Date functions */
    
    public static function adddate()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function addtime()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function curdate()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function currentDate()
    {
        return new FunctionExpression('CURRENT_DATE');
    }
    
    public static function currentTime()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function currentTimestamp()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function curtime()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function date($_expr)
    {
        return new FunctionExpression('DATE', $_expr);
    }
    
    public static function datediff()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function dateAdd($_date, $_value, string $_unit)
    {
        return new FunctionExpression('DATE_ADD', $_date, Interval::from($_value, $_unit));
    }
    
    public static function dateFormat()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function dateSub($_date, $_value, string $_unit)
    {
        return new FunctionExpression('DATE_SUB', $_date, Interval::from($_value, $_unit));
    }
    
    public static function day()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function dayname()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function dayofmonth()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function dayofweek()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function dayofyear()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function extract()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function fromDays()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function hour()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function lastDay()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function localtime()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function localtimestamp()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function makedate()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function maketime()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function microsecond()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function minute()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function month()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function monthname()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function now()
    {
        return new FunctionExpression('NOW');
    }
    
    public static function periodAdd()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function periodDiff()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function quarter()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function second()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function secToTime()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function strToDate()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function subdate()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function subtime()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function sysdate()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function time()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function timeFormat()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function timeToSec()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function timediff()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function timestamp()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function toDays()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function week()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function weekday()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function weekofyear()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function year()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function yearweek()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    /** Advanced functions */
    public static function bin()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function binary()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function case()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function cast($_expression, string $_dataType)
    {
        return Expr::cast($_expression, $_dataType);
    }
    
    public static function coalesce(...$_nullTest)
    {
        return new FunctionExpression('COALESCE', ...$_nullTest);
    }
    
    public static function connectionId()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function conv()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function convert($_value, $_type)
    {
        return new ConvertFunction($_value, $_type);
    }
    
    public static function currentUser()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function database()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function if($_test, $_then, $_else)
    {
        return new FunctionExpression('IF', $_test, $_then, $_else);
    }
    
    public static function ifnull($_value, $_coalesce)
    {
        return new FunctionExpression('IFNULL', $_value, $_coalesce);
    }
    
    public static function isnull()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function lastInsertId()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function nullif()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function sessionUser()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function systemUser()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function user()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    public static function version()
    {
        throw new \RuntimeException(__FUNCTION__." requires implementation.");
    }
    
    /** Other functions */
    public static function uuid()
    {
        return new FunctionExpression('UUID');
    }
    
    public static function groupConcat($_column)
    {
        return new FunctionExpression('GROUP_CONCAT', $_column instanceof QueryExpressionInterface ? $_column : Column::from($_column));
    }
    
    public static function openquery(string $_linkServer, string $_query)
    {
        return new FunctionExpression('OPENQUERY', Expr::identifier($_linkServer), Expr::literal("'{$_query}'"));
    }
}