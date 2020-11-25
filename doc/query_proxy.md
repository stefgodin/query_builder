## Query Builder Proxy
As seen in the previous example. Raw usage of the query builder can become quite confusing.  
This is when `QueryBuilderProxy` comes into play to clean up your code and allow reuse of sub queries.


#### Typical usage
A `QueryBuilderProxy` is very useful and allow reusable select queries.  
Here is an example without:
```php
<?php
use Stefmachine\QueryBuilder\QueryBuilder;
use Stefmachine\QueryBuilder\Expressions\Func;
use Stefmachine\QueryBuilder\Expressions\Expr;

$MySubTable = QueryBuilder::select([
  'my_table.id',
  'total' => Func::sum('join_table.number')
])->from('my_table')
  ->innerJoin('join_table', null, ['join_table.id' => 'my_table.join_id'])
  ->groupBy('my_table.id');

// First usage
QueryBuilder::select(['total' => Func::sum('total')])
    ->from(
        //We make a copy to prevent modification in other queries since the builder is mutable
        $MySubTable->copy()
    , 'tbl_alias');

// ... many LoC later

// Second usage
QueryBuilder::select(['total' => Func::sum('total')])
    ->from(
        $MySubTable->copy()
            ->having([
                Expr::greaterThan('total', 100)
            ])
    , 'tbl_alias');

```

Now with `QueryBuilderProxy`
```php
<?php
use Stefmachine\QueryBuilder\Builder\SelectQueryBuilder;
use Stefmachine\QueryBuilder\QueryBuilderProxy;
use Stefmachine\QueryBuilder\QueryBuilder;
use Stefmachine\QueryBuilder\Expressions\Func;
use Stefmachine\QueryBuilder\Expressions\Expr;

class MySubTable extends QueryBuilderProxy
{
    protected function buildQuery(): SelectQueryBuilder {
        return QueryBuilder::select([
            'my_table.id',
            'total' => Func::sum('join_table.number')
        ])->from('my_table')
            ->innerJoin('join_table', null, ['join_table.id' => 'my_table.join_id'])
            ->groupBy('my_table.id');
    }
    
    // Allowing usage of having on the table query
    public function having(array $_criteria)
    {
        return parent::having($_criteria);
    }
}

// First usage
QueryBuilder::select(['total' => Func::sum('total')])
    ->from(MySubTable::get(), 'tbl_alias');

// ... many LoC later

// Second usage
QueryBuilder::select(['total' => Func::sum('total')])
    ->from(
        MySubTable::get()
            ->having([
                Expr::greaterThan('total', 100)
            ])
    , 'tbl_alias');
```

#### Sub querying with a proxy 
One of the biggest problem we encounter by wrapping the `QueryBuilder` in a proxy is that we loose the flexibility of sub querying.
```php
<?php
use Stefmachine\QueryBuilder\Builder\SelectQueryBuilder;
use Stefmachine\QueryBuilder\QueryBuilderProxy;
use Stefmachine\QueryBuilder\QueryBuilder;
use Stefmachine\QueryBuilder\Expressions\Func;


class MySubTable extends QueryBuilderProxy
{
    protected function buildQuery(): SelectQueryBuilder {
        return QueryBuilder::select([
            'sub_query.id',
            'total' => Func::sum('join_table.number')
        ])->from(
                QueryBuilder::select()
                    ->from('my_table')
            , 'sub_query')
            ->innerJoin('join_table', null, ['join_table.id' => 'sub_query.join_id'])
            ->groupBy('sub_query.id');
    }
}

QueryBuilder::select()
    ->from(
        MySubTable::get()
            ->where([
                'my_table.x' => 'y' //won't work since my_table is wrapped in sub query    
            ])
    , 'sub_table');
```

There is a way to circumvent this.
```php
<?php
use Stefmachine\QueryBuilder\Builder\SelectQueryBuilder;
use Stefmachine\QueryBuilder\QueryBuilderProxy;
use Stefmachine\QueryBuilder\QueryBuilder;
use Stefmachine\QueryBuilder\Expressions\Func;


class MySubTable extends QueryBuilderProxy
{
    protected $myTable;
    
    protected function buildQuery(): SelectQueryBuilder {
        $this->myTable = QueryBuilder::select()
            ->from('my_table');
        
        return QueryBuilder::select([
            'sub_query.id',
            'total' => Func::sum('join_table.number')
        ])->from($this->myTable, 'sub_query')
            ->innerJoin('join_table', null, ['join_table.id' => 'sub_query.join_id'])
            ->groupBy('sub_query.id');
    }
    
    public function queryMyTable(callable $_callable)
    {
        call_user_func($_callable, $this->myTable); //The callable is given an instance of the sub query builder
        return $this; //Required for builder pattern
    }
}

QueryBuilder::select()
    ->from(
        MySubTable::get()
            ->queryMyTable(function(SelectQueryBuilder $_table){
                $_table->where([
                   'my_table.x' => 'y' //won't work since my_table is wrapped in sub query    
                ]);
            })
    , 'sub_table');
```

This means that you can now optimise your queries to the next level AND keep things clean and separated.

Note that you can also nest `QueryBuilderProxies` within one another and still get access to their internal API.