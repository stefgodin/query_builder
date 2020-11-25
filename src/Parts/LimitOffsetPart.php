<?php


namespace Stefmachine\QueryBuilder\Parts;

use Stefmachine\QueryBuilder\Adapter\AdapterInterface;
use Stefmachine\QueryBuilder\Builder\QueryBuilderInterface;

class LimitOffsetPart implements QueryPartInterface
{
    protected $limit;
    protected $offset;
    
    public function __construct(int $_offset = null, int $_limit = null)
    {
        $this->limit = $_limit;
        $this->offset = $_offset;
    }
    
    public static function from(int $_offset = null, int $_limit = null)
    {
        return new static($_offset, $_limit);
    }
    
    public function setLimit(?int $_limit)
    {
        $this->limit = $_limit;
    }
    
    public function setOffset(?int $_offset)
    {
        $this->offset = $_offset;
    }
    
    public function buildOnQuery(QueryBuilderInterface $_qb, AdapterInterface $_adapter): string
    {
        $limit = $this->limit;
        $offset = $this->offset;
        if($_adapter->getDriverName() == "mysql"){
            if($offset !== null && $limit === null){
                /**
                 * We can't use offset without limit...
                 * Using a big number is the official way according to MYSQL doc.
                 * Using PHP_INT_MAX would prevent overflow
                 */
                $limit = PHP_INT_MAX;
            }
            
            if($limit !== null){
                $limit = $_qb->addParam($limit);
                $limit = "LIMIT {$limit}";
            }
            
            if($offset !== null){
                $offset = $_qb->addParam($offset);
                $offset = "OFFSET {$offset}";
            }
            
            return rtrim("{$limit} {$offset}");
        }
        else{
            if($offset !== null){
                //$offset = $_qb->addParam($offset);
                $offset = "OFFSET {$offset} ROWS";
            }
            
            if($limit !== null){
                //$limit = $_qb->addParam($limit);
                $limit = "FETCH NEXT {$limit} ROWS ONLY";
            }
    
            return rtrim("{$offset} {$limit}");
        }
    
    }
}