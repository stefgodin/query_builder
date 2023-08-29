<?php


namespace Stefmachine\QueryBuilder;


class Query implements QueryInterface
{
    protected string $sql;
    protected array $parameters;
    
    public function __construct(string $_sql, array $_parameters)
    {
        $this->sql = $_sql;
        $this->parameters = $_parameters;
    }
    
    public function getParameters(): array
    {
        return $this->parameters;
    }
    
    public function getSql(): string
    {
        return $this->sql;
    }
    
    public function dump(): string
    {
        $params = array();
        foreach ($this->getParameters() as $param => $value){
            if(is_string($value)){
                $value = "'{$value}'";
            }
            $params[":{$param}"] = $value;
        }
        
        return strtr($this->sql, $params);
    }
}