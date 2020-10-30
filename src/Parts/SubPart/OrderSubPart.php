<?php


namespace Stefmachine\QueryBuilder\Parts\SubPart;


class OrderSubPart
{
    protected $field;
    protected $ascending;
    
    public function __construct($_field, bool $_ascending = true)
    {
        $this->field = $_field;
        $this->ascending = $_ascending;
    }
    
    public function getField()
    {
        return $this->field;
    }
    
    public function isAscending()
    {
        return $this->ascending;
    }
}