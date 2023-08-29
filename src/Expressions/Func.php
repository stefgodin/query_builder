<?php


namespace Stefmachine\QueryBuilder\Expressions;


final class Func
{
    private function __construct(){}
    
    /** String functions */
    
    public static function ascii($_character)
    {
        return new FunctionExpression('ASCII', $_character);
    }
    
    public static function charLength($_string)
    {
        return new FunctionExpression('CHAR_LENGTH', $_string);
    }
    
    public static function characterLength($_string)
    {
        return new FunctionExpression('CHARACTER_LENGTH', $_string);
    }
    
    public static function concat(...$_expr)
    {
        return new FunctionExpression('CONCAT', ...$_expr);
    }
    
    public static function concatWs($_separator, ...$_expr)
    {
        return new FunctionExpression('CONCAT_WS', $_separator, ...$_expr);
    }
    
    public static function field($_value, ...$_vals)
    {
        return new FunctionExpression('FIELD', $_value, ...$_vals);
    }
    
    public static function findInSet($_string, $_stringList)
    {
        return new FunctionExpression('FIND_IN_SET', $_string, $_stringList);
    }
    
    public static function format($_number, $_decimalPlaces)
    {
        return new FunctionExpression('FORMAT', $_number, $_decimalPlaces);
    }
    
    public static function insert($_string, $_position, $_number, $_insertString)
    {
        return new FunctionExpression('INSERT', $_string, $_position, $_number, $_insertString);
    }
    
    public static function instr($_string, $_searchString)
    {
        return new FunctionExpression('INSTR', $_string, $_searchString);
    }
    
    public static function lcase($_text)
    {
        return new FunctionExpression('LCASE', $_text);
    }
    
    public static function left($_string, $_length)
    {
        return new FunctionExpression('LEFT', $_string, $_length);
    }
    
    public static function length($_string)
    {
        return new FunctionExpression('LENGTH', $_string);
    }
    
    public static function locate($_substring, $_string, $_start = 1)
    {
        return new FunctionExpression('LOCATE', $_substring, $_string, $_start);
    }
    
    public static function lower($_text)
    {
        return new FunctionExpression('LOWER', $_text);
    }
    
    public static function lpad($_text, $_padLength, $_padString)
    {
        return new FunctionExpression('LPAD', $_text, $_padLength, $_padString);
    }
    
    public static function ltrim($_string)
    {
        return new FunctionExpression('LTRIM', $_string);
    }
    
    public static function mid($_string, $_start, $_length)
    {
        return new FunctionExpression('MID', $_string, $_start, $_length);
    }
    
    public static function position($_substring, $_string)
    {
        return new FunctionExpression('POSITION', $_substring, $_string);
    }
    
    public static function repeat($_string, $_count)
    {
        return new FunctionExpression('REPEAT', $_string, $_count);
    }
    
    public static function replace($_subject, $_search, $_replace)
    {
        return new FunctionExpression('REPLACE', $_subject, $_search, $_replace);
    }
    
    public static function reverse($_string)
    {
        return new FunctionExpression('REVERSE', $_string);
    }
    
    public static function right($_string, $_length)
    {
        return new FunctionExpression('RIGHT', $_string, $_length);
    }
    
    public static function rpad($_string, $_length, $_padString)
    {
        return new FunctionExpression('RPAD', $_string, $_length, $_padString);
    }
    
    public static function rtrim($_string)
    {
        return new FunctionExpression('RTRIM', $_string);
    }
    
    public static function space($_count)
    {
        return new FunctionExpression('SPACE', $_count);
    }
    
    public static function strcmp($_string1, $_string2)
    {
        return new FunctionExpression('STRCMP', $_string1, $_string2);
    }
    
    public static function substr($_string, $_start, $_length)
    {
        return new FunctionExpression('SUBSTR', $_string, $_start, $_length);
    }
    
    public static function substring($_string, $_start, $_length)
    {
        return new FunctionExpression('SUBSTRING', $_string, $_start, $_length);
    }
    
    public static function substringIndex($_text, $_delimiter, $_number)
    {
        return new FunctionExpression('SUBSTRING_INDEX', $_text, $_delimiter, $_number);
    }
    
    public static function trim($_value)
    {
        return new FunctionExpression('TRIM', $_value);
    }
    
    public static function ucase($_text)
    {
        return new FunctionExpression('UCASE', $_text);
    }
    
    public static function upper($_text)
    {
        return new FunctionExpression('UPPER', $_text);
    }
    
    
    /** Numeric functions */
    
    public static function abs($_number)
    {
        return new FunctionExpression('ABS', $_number);
    }
    
    public static function acos($_number)
    {
        return new FunctionExpression('ACOS', $_number);
    }
    
    public static function asin($_number)
    {
        return new FunctionExpression('ASIN', $_number);
    }
    
    public static function atan($_number)
    {
        return new FunctionExpression('ATAN', $_number);
    }
    
    public static function atan2($_y, $_x)
    {
        return new FunctionExpression('ATAN2', $_y, $_x);
    }
    
    public static function avg($_expr)
    {
        return new FunctionExpression('AVG', $_expr);
    }
    
    public static function ceil($_number)
    {
        return new FunctionExpression('CEIL', $_number);
    }
    
    public static function ceiling($_number)
    {
        return new FunctionExpression('CEILING', $_number);
    }
    
    public static function cos($_number)
    {
        return new FunctionExpression('COS', $_number);
    }
    
    public static function cot($_number)
    {
        return new FunctionExpression('COT', $_number);
    }
    
    public static function count($_column)
    {
        return new FunctionExpression('COUNT', $_column instanceof QueryExpressionInterface ? $_column : Column::from($_column));
    }
    
    public static function degrees($_value)
    {
        return new FunctionExpression('DEGREES', $_value);
    }
    
    public static function div($_dividend, $_divisor)
    {
        return new FunctionExpression('DIV', $_dividend, $_divisor);
    }
    
    public static function exp($_value)
    {
        return new FunctionExpression('EXP', $_value);
    }
    
    public static function floor($_value)
    {
        return new FunctionExpression('FLOOR', $_value);
    }
    
    public static function greatest(...$_values)
    {
        return new FunctionExpression('GREATEST', ...$_values);
    }
    
    public static function least(...$_values)
    {
        return new FunctionExpression('LEAST', ...$_values);
    }
    
    public static function ln($_value)
    {
        return new FunctionExpression('LN', $_value);
    }
    
    public static function log($_value, $_base = null)
    {
        if ($_base === null) {
            return new FunctionExpression('LOG', $_value);
        } else {
            return new FunctionExpression('LOG', $_value, $_base);
        }
    }
    
    public static function log10($_value)
    {
        return new FunctionExpression('LOG10', $_value);
    }
    
    public static function log2($_value)
    {
        return new FunctionExpression('LOG2', $_value);
    }
    
    public static function max($_column)
    {
        return new FunctionExpression('MAX', $_column instanceof QueryExpressionInterface ? $_column : Column::from($_column));
        
    }
    
    public static function min($_column)
    {
        return new FunctionExpression('MIN', $_column instanceof QueryExpressionInterface ? $_column : Column::from($_column));
    }
    
    public static function mod($_dividend, $_divisor)
    {
        return new FunctionExpression('MOD', $_dividend, $_divisor);
    }
    
    public static function pi()
    {
        return new FunctionExpression('PI');
    }
    
    public static function pow($_base, $_exponent)
    {
        return new FunctionExpression('POW', $_base, $_exponent);
    }
    
    public static function power($_base, $_exponent)
    {
        return new FunctionExpression('POWER', $_base, $_exponent);
    }
    
    public static function radians($_degrees)
    {
        return new FunctionExpression('RADIANS', $_degrees);
    }
    
    public static function rand($_seed = null)
    {
        if($_seed === null){
            return new FunctionExpression('RAND');
        }
        
        return new FunctionExpression('RAND', $_seed);
    }
    
    public static function round($_value)
    {
        return new FunctionExpression('ROUND', $_value);
    }
    
    public static function sign($_value)
    {
        return new FunctionExpression('SIGN', $_value);
    }
    
    public static function sin($_value)
    {
        return new FunctionExpression('SIN', $_value);
    }
    
    public static function sqrt($_value)
    {
        return new FunctionExpression('SQRT', $_value);
    }
    
    public static function sum($_column)
    {
        return new FunctionExpression('SUM', $_column instanceof QueryExpressionInterface ? $_column : Column::from($_column));
    }
    
    public static function tan($_value)
    {
        return new FunctionExpression('TAN', $_value);
    }
    
    public static function truncate($_number, $_decimals)
    {
        return new FunctionExpression('TRUNCATE', $_number, $_decimals);
    }
    
    /** Date functions */
    
    public static function addDate($_date, $_value, string $_unit)
    {
        return new FunctionExpression('ADDDATE', $_date, Interval::from($_value, $_unit));
    }
    
    public static function addTime($_time, $_value, string $_unit)
    {
        return new FunctionExpression('ADDTIME', $_time, Interval::from($_value, $_unit));
    }
    
    public static function curDate()
    {
        return new FunctionExpression('CURDATE');
    }
    
    public static function currentDate()
    {
        return new FunctionExpression('CURRENT_DATE');
    }
    
    public static function currentTime()
    {
        return new FunctionExpression('CURRENT_TIME');
    }
    
    public static function currentTimestamp()
    {
        return new FunctionExpression('CURRENT_TIMESTAMP');
    }
    
    public static function curTime()
    {
        return new FunctionExpression('CURTIME');
    }
    
    public static function date($_expr)
    {
        return new FunctionExpression('DATE', $_expr);
    }
    
    public static function dateDiff($_date1, $_date2)
    {
        return new FunctionExpression('DATEDIFF', $_date1, $_date2);
    }
    
    public static function dateAdd($_date, $_value, string $_unit)
    {
        return new FunctionExpression('DATE_ADD', $_date, Interval::from($_value, $_unit));
    }
    
    public static function dateFormat($_date, $_format)
    {
        return new FunctionExpression('DATE_FORMAT', $_date, $_format);
    }
    
    public static function dateSub($_date, $_value, string $_unit)
    {
        return new FunctionExpression('DATE_SUB', $_date, Interval::from($_value, $_unit));
    }
    
    public static function day($_date)
    {
        return new FunctionExpression('DAY', $_date);
    }
    
    public static function dayName($_date)
    {
        return new FunctionExpression('DAYNAME', $_date);
    }
    
    public static function dayOfMonth($_date)
    {
        return new FunctionExpression('DAYOFMONTH', $_date);
    }
    
    public static function dayOfWeek($_date)
    {
        return new FunctionExpression('DAYOFWEEK', $_date);
    }
    
    public static function dayOfYear($_date)
    {
        return new FunctionExpression('DAYOFYEAR', $_date);
    }
    
    public static function extract(string $_part, $_date)
    {
        return new Extract($_part, $_date);
    }
    
    public static function fromDays($_days)
    {
        return new FunctionExpression('FROM_DAYS', $_days);
    }
    
    public static function hour($_datetime)
    {
        return new FunctionExpression('HOUR', $_datetime);
    }
    
    public static function lastDay($_date)
    {
        return new FunctionExpression('LAST_DAY', $_date);
    }
    
    public static function localTime()
    {
        return new FunctionExpression('LOCALTIME');
    }
    
    public static function localTimestamp()
    {
        return new FunctionExpression('LOCALTIMESTAMP');
    }
    
    public static function makeDate($_year, $_dayOfYear)
    {
        return new FunctionExpression('MAKEDATE', $_year, $_dayOfYear);
    }
    
    public static function makeTime($_hour, $_minute, $_second)
    {
        return new FunctionExpression('MAKETIME', $_hour, $_minute, $_second);
    }
    
    public static function microsecond($_datetime)
    {
        return new FunctionExpression('MICROSECOND', $_datetime);
    }
    
    public static function minute($_datetime)
    {
        return new FunctionExpression('MINUTE', $_datetime);
    }
    
    public static function month($_date)
    {
        return new FunctionExpression('MONTH', $_date);
    }
    
    public static function monthName($_date)
    {
        return new FunctionExpression('MONTHNAME', $_date);
    }
    
    public static function now()
    {
        return new FunctionExpression('NOW');
    }
    
    public static function periodAdd($_date, $_months)
    {
        return new FunctionExpression('DATE_ADD', $_date, $_months);
    }
    
    public static function periodDiff($_date1, $_date2)
    {
        return new FunctionExpression('PERIOD_DIFF', $_date1, $_date2);
    }
    
    public static function quarter($_date)
    {
        return new FunctionExpression('QUARTER', $_date);
    }
    
    public static function second($_time)
    {
        return new FunctionExpression('SECOND', $_time);
    }
    
    public static function secToTime($_seconds)
    {
        return new FunctionExpression('SEC_TO_TIME', $_seconds);
    }
    
    public static function strToDate($_dateStr, $_format)
    {
        return new FunctionExpression('STR_TO_DATE', $_dateStr, $_format);
    }
    
    public static function subdate($_date, $_value, ?string $_unit = null)
    {
        if($_unit !== null){
            return new FunctionExpression('SUBDATE', $_date, Interval::from($_value, $_unit));
        }
        
        return new FunctionExpression('SUBDATE', $_date, $_value);
    }
    
    public static function subtime($_datetime, $_timeInterval)
    {
        return new FunctionExpression('SUBTIME', $_datetime, $_timeInterval);
    }
    
    public static function sysDate()
    {
        return new FunctionExpression('SYSDATE');
    }
    
    public static function time($_expr)
    {
        return new FunctionExpression('TIME', $_expr);
    }
    
    public static function timeFormat($_time, $_format)
    {
        return new FunctionExpression('TIME_FORMAT', $_time, $_format);
    }
    
    public static function timeToSec($_time)
    {
        return new FunctionExpression('TIME_TO_SEC', $_time);
    }
    
    public static function timeDiff($_time1, $_time2)
    {
        return new FunctionExpression('TIMEDIFF', $_time1, $_time2);
    }
    
    public static function timestamp($_datetime, $_time = null)
    {
        if($_time !== null){
            return new FunctionExpression('TIMESTAMP', $_datetime, $_time);
        }
        
        return new FunctionExpression('TIMESTAMP', $_datetime);
    }
    
    public static function toDays($_date)
    {
        return new FunctionExpression('TO_DAYS', $_date);
    }
    
    public static function week($_date, $_firstDayOfWeek = null)
    {
        if($_firstDayOfWeek !== null){
            return new FunctionExpression('WEEK', $_date, $_firstDayOfWeek);
        }
        
        return new FunctionExpression('WEEK', $_date);
    }
    
    public static function weekDay($_date)
    {
        return new FunctionExpression('WEEKDAY', $_date);
    }
    
    public static function weekOfYear($_date)
    {
        return new FunctionExpression('WEEKOFYEAR', $_date);
    }
    
    public static function year($_date)
    {
        return new FunctionExpression('YEAR', $_date);
    }
    
    public static function yearWeek($_date, $_firstDayOfWeek = null)
    {
        if($_firstDayOfWeek !== null){
            return new FunctionExpression('YEARWEEK', $_date, $_firstDayOfWeek);
        }
        
        return new FunctionExpression('YEARWEEK', $_date);
    }
    
    /** Advanced functions */
    public static function bin($_number)
    {
        return new FunctionExpression('BIN', $_number);
    }
    
    public static function binary($_value)
    {
        return new Binary($_value);
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
        return new FunctionExpression('CONNECTION_ID');
    }
    
    public static function conv($_number, $_fromBase, $_toBase)
    {
        return new FunctionExpression('CONV', $_number, $_fromBase, $_toBase);
    }
    
    public static function convert($_value, $_type)
    {
        return new ConvertFunction($_value, $_type);
    }
    
    public static function currentUser()
    {
        return new FunctionExpression('CURRENT_USER');
    }
    
    public static function database()
    {
        return new FunctionExpression('DATABASE');
    }
    
    public static function if($_test, $_then, $_else)
    {
        return new FunctionExpression('IF', $_test, $_then, $_else);
    }
    
    public static function ifNull($_value, $_coalesce)
    {
        return new FunctionExpression('IFNULL', $_value, $_coalesce);
    }
    
    public static function isNull($_expr)
    {
        return new FunctionExpression('ISNULL', $_expr);
    }
    
    public static function lastInsertId($_expr = null)
    {
        if($_expr !== null){
            return new FunctionExpression('LAST_INSERT_ID', $_expr);
        }
        
        return new FunctionExpression('LAST_INSERT_ID');
    }
    
    public static function nullIf($_expr1, $_expr2)
    {
        return new FunctionExpression('NULLIF', $_expr1, $_expr2);
    }
    
    public static function sessionUser()
    {
        return new FunctionExpression('SESSION_USER');
    }
    
    public static function systemUser()
    {
        return new FunctionExpression('SYSTEM_USER');
    }
    
    public static function user()
    {
        return new FunctionExpression('USER');
    }
    
    public static function version()
    {
        return new FunctionExpression('VERSION');
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
    
    public static function openQuery(string $_linkServer, string $_query)
    {
        return new FunctionExpression('OPENQUERY', Expr::identifier($_linkServer), Expr::literal("'{$_query}'"));
    }
}