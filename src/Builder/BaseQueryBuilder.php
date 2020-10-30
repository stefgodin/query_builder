<?php


namespace Stefmachine\QueryBuilder\Builder;


use Clyvanor\Persistence\Adapter\AdapterInterface;
use Stefmachine\QueryBuilder\Query;
use Stefmachine\QueryBuilder\Converter\ChainConverter;
use Stefmachine\QueryBuilder\Expressions\QueryExpressionInterface;
use Stefmachine\QueryBuilder\Parts\QueryPartInterface;
use Stefmachine\QueryBuilder\QueryInterface;

abstract class BaseQueryBuilder implements QueryBuilderInterface, QueryPartInterface
{
    /** @var QueryPartInterface[] */
    protected $queryParts;
    /** @var array */
    protected $params;
    /** @var AdapterInterface|null */
    protected $adapter;
    
    /**
     * @var BaseQueryBuilder|null
     *
     * The parent query is only set during the build time
     */
    private $parentQuery;
    
    public function __construct()
    {
        $this->queryParts = array();
        $this->params = array();
    }
    
    public static function create()
    {
        return new static();
    }
    
    abstract protected function getTemplate(AdapterInterface $_adapter): string;
    
    private function getEmptyQueryParts(AdapterInterface $_adapter)
    {
        preg_match_all('/\{([A-Z_]+)\}/', $this->getTemplate($_adapter), $matches);
        
        $parts = $matches[1] ?? [];
        $emptyParts = [];
        foreach ($parts as $part){
            $emptyParts[$part] = null;
        }
        return $emptyParts;
    }
    
    protected function setPart(string $_name, QueryPartInterface $_part)
    {
        $this->queryParts[strtoupper($_name)] = $_part;
        return $this;
    }
    
    protected function getPart(string $_name): ?QueryPartInterface
    {
        return $this->queryParts[strtoupper($_name)] ?? null;
    }
    
    /**
     * Adds a parameter to the query and returns the new parameter name
     * If the value is found in the parameter list (strict search), we reuse it
     *
     * @param $_value
     * @return string
     */
    public function addParam($_value): string
    {
        if($this->parentQuery instanceof BaseQueryBuilder){
            return $this->parentQuery->addParam($_value);
        }
        else{
            $name = null;
            if($this->adapter->allowsParametersOptimization()){
                $index = array_search($_value, $this->params, true);
                if($index !== false){
                    $name = $index;
                }
            }
            
            if($name === null){
                $name = 'v'.(count($this->params) + 1);
                $this->params[$name] = $_value;
            }
            
            return ":{$name}";
        }
    }
    
    /**
     * Builds a Query from the current builder state
     *
     * @param AdapterInterface $_adapter
     * @return QueryInterface
     */
    public function getQuery(AdapterInterface $_adapter): QueryInterface
    {
        $oldAdapter = $this->adapter;
        $this->adapter = $this->adapter ?: $_adapter;
        
        $currentParts = array_merge($this->getEmptyQueryParts($this->adapter), $this->queryParts);
        $parts = array();
        $emptyParts = array();
        foreach ($currentParts as $name => $part){
            $name = strtoupper($name);
            if($part instanceof QueryPartInterface){
                $parts["{{$name}}"] = $part->buildOnQuery($this, $this->adapter);
            }
            else{
                $emptyParts["{{$name}}"] = "";
            }
        }
    
        $template = rtrim(preg_replace('/\s+/', ' ', strtr(
            $this->getTemplate($this->adapter),
            $emptyParts
        )));
    
        $sql = strtr(
            $template,
            $parts
        );
    
        $params = array();
        foreach ($this->params as $param => $value){
            $params[$param] = ChainConverter::convert($value, $this->adapter);
        }
    
        $this->adapter = $oldAdapter;
        
        return new Query($sql, $params);
    }
    
    protected function canWrapOnBuild(): bool
    {
        return false;
    }
    
    /**
     * Used when building in a sub-query
     *
     * @param QueryBuilderInterface $_qb
     * @param AdapterInterface $_adapter
     * @return string
     */
    public function buildOnQuery(QueryBuilderInterface $_qb, AdapterInterface $_adapter): string
    {
        $adapter = $this->adapter ?: $_adapter;
        
        $this->parentQuery = $_qb;
        $query = $this->getQuery($adapter);
        $this->parentQuery = null;
        return $this->canWrapOnBuild() ? "({$query->getSql()})" : $query->getSql();
    }
    
    /**
     * Manually setting the adapter will force the usage of it even when given another adapter
     *
     * @param AdapterInterface $_adapter
     * @return $this
     */
    public function with(AdapterInterface $_adapter)
    {
        $this->adapter = $_adapter;
        return $this;
    }
    
    /**
     * @return static
     */
    public function copy()
    {
        return clone $this;
    }
    
    public function __clone()
    {
        foreach ($this->queryParts as $index => $part){
            $this->queryParts[$index] = $part instanceof QueryPartInterface ? clone $part : $part;
        }
    }
}