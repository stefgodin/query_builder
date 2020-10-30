<?php


namespace Stefmachine\QueryBuilder\Expressions;


final class Expr
{
    private function __construct(){}
    
    public static function literal($_value)
    {
        return new Literal($_value);
    }
    
    public static function smartEquals($_field, $_value)
    {
        if(is_null($_value)){
            return self::isNull($_field);
        }
        else if(is_array($_value)){
            return self::in($_field, $_value);
        }
        else{
            return self::equals($_field, $_value);
        }
    }
    
    public static function smartNotEquals($_field, $_value)
    {
        if(is_null($_value)){
            return self::notNull($_field);
        }
        else if(is_array($_value)){
            return self::notIn($_field, $_value);
        }
        else{
            return self::notEqual($_field, $_value);
        }
    }
    
    public static function equals($_field, $_value)
    {
        return new Equals($_field, $_value);
    }
    
    public static function notEqual($_field, $_value)
    {
        return new NotEqual($_field, $_value);
    }
    
    public static function lessThan($_field, $_value)
    {
        return new LessThan($_field, $_value);
    }
    
    public static function lessThanOrEqual($_field, $_value)
    {
        return new LessThanOrEqual($_field, $_value);
    }
    
    public static function greaterThan($_field, $_value)
    {
        return new GreaterThan($_field, $_value);
    }
    
    public static function greaterThanOrEqual($_field, $_value)
    {
        return new GreaterThanOrEqual($_field, $_value);
    }
    
    public static function isNull($_field)
    {
        return new IsNull($_field);
    }
    
    public static function notNull($_field)
    {
        return new NotNull($_field);
    }
    
    public static function in($_field, $_in)
    {
        return new In($_field, $_in);
    }
    
    public static function notIn($_field, $_notIn)
    {
        return new NotIn($_field, $_notIn);
    }
    
    public static function between($_field, $_start, $_end)
    {
        return new Between($_field, $_start, $_end);
    }
    
    public static function plus($_a, $_b)
    {
        return new SimpleOperator('+', $_a, $_b);
    }
    
    public static function minus($_a, $_b)
    {
        return new SimpleOperator('-', $_a, $_b);
    }
    
    public static function mult($_a, $_b)
    {
        return new SimpleOperator('*', $_a, $_b);
    }
    
    public static function div($_a, $_b)
    {
        return new SimpleOperator('/', $_a, $_b);
    }
    
    public static function interval($_expr, string $_unit)
    {
        return new Interval($_expr, $_unit);
    }
    
    public static function orX(QueryExpressionInterface ...$_or)
    {
        return new OrX(...$_or);
    }
    
    public static function andX(QueryExpressionInterface ...$_and)
    {
        return new AndX(...$_and);
    }
    
    public static function switchCase(): SwitchCaseExpressionInterface
    {
        return new SwitchExpression();
    }
    
    public static function cast($_expression, string $_dataType)
    {
        return Cast::from($_expression, $_dataType);
    }
    
    public static function if($_condition, $_trueValue, $_falseValue)
    {
        return Func::if($_condition, $_trueValue, $_falseValue);
    }
    
    public static function column($_name)
    {
        return new Column($_name);
    }
    
    public static function allColumns($_table = null)
    {
        return new StarColumn($_table);
    }
    
    public static function value($_value)
    {
        return new Value($_value);
    }
    
    public static function like($_field, $_like)
    {
        return new Like($_field, $_like);
    }
    
    public static function not(QueryExpressionInterface $_expr)
    {
        return new Not($_expr);
    }
    
    public static function func(string $_name, ...$_parameters)
    {
        return new FunctionExpression($_name, ...$_parameters);
    }
    
    public static function distinct(...$_columns)
    {
        return Distinct::from(...$_columns);
    }
    
    public static function identifier(string $_identifier)
    {
        return Identifier::from($_identifier);
    }
}