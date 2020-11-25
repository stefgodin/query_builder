<?php


namespace Stefmachine\QueryBuilder\Builder;


use Stefmachine\QueryBuilder\Adapter\AdapterInterface;
use Stefmachine\QueryBuilder\Parts\FunctionPart;

class StoredProcQueryBuilder extends BaseQueryBuilder
{
    protected function getTemplate(AdapterInterface $_adapter): string
    {
        return 'CALL {FUNCTION}';
    }
    
    public static function create(?string $_storedProc = null, array $_params = array())
    {
        $part = new static();
        
        if($_storedProc !== null){
            $part->call($_storedProc, $_params);
        }
        
        return $part;
    }
    
    public function call(string $_storedProc, array $_params)
    {
        $this->setPart('FUNCTION', FunctionPart::from($_storedProc, $_params));
    }
}