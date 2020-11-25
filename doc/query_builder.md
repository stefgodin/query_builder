## Query Builder
The query builder uses the builder pattern to build queries for prepared statements.  
Example:
```php
<?php
use Stefmachine\QueryBuilder\QueryBuilder;
use Stefmachine\QueryBuilder\Adapter\MysqlQueryAdapter;
use Stefmachine\QueryBuilder\Expressions\Expr;
use Stefmachine\QueryBuilder\Expressions\Func;

$query = QueryBuilder::select(['field1', 'alias' => 'field2'])
    ->from('my_table', 'tbl_alias')
    ->innerJoin('link_table', 'link_alias', ['link_alias.link_column' => 'tbl_alias.column'])
    ->where([ // Adding criteria with AND
        'some_field' => 'bonjour',                  // SQL -> AND some_field = 'bonjour'
        Expr::greaterThan('some_other_field', 400), // SQL -> AND some_other_field > 400
        'another_field' => Func::now(),             // SQL -> AND another_field = NOW(),
        Expr::orX(                                  // Adding sub criteria with OR ... SQL -> AND (criteria_1 OR criteria_2 ... OR ...)
            Expr::notNull('my_not_null_field'),     // SQL -> AND (my_not_null_field IS NOT NULL
            Expr::equals('some_field', 'bonjour')   // SQL -> OR some_field = 'bonjour')
        )
    ]) //WHERE
    ->getQuery(new MysqlQueryAdapter()); // Specifying the adapter

$query->getSql(); // The resulting SQL query string
$query->getParameters(); // An associative array of paramName => value
```

Most values inside the QueryBuilder can be replaced with implementations of QueryExpressionInterface.  

Note that the QueryBuilder implements the QueryExpressionInterface and thus can be nested inside another QueryBuilder to create very complex queries.

Crazy example below (I don't expect you to take the time to read all of this):
```php
<?php
use Stefmachine\QueryBuilder\QueryBuilder;
use Stefmachine\QueryBuilder\Expressions\Func;
use Stefmachine\QueryBuilder\Expressions\Expr;

$queryBuilder = QueryBuilder::select()
    ->from('saw', 's')
    ->innerJoin(
        QueryBuilder::select([
            'no_status', 
            'no_order', 
            'machine_id', 
            'ManualSawStatus',
            'saw_startedAt',
            'USERID', 
            'idSaw',
            'Qty' => Func::sum('Qty'),
            'Gab' => Func::sum('Gab')
        ])->from('mitek_batchinfo', 'MBI2')
            ->innerJoin('sawbatch', 'SB2', ['SB2.StructureGroupsId' => 'MBI2.StructureGroupsId'])
            ->where([Expr::between('no_status', 2.8, 3.1)])
            ->groupBy('USERID', 'idSaw'),
        'vSaw', ['vSaw.idSaw' => 's.idSaw'])
    ->innerJoin('orders', 'o', ['vSaw.no_order' => 'o.no'])
    ->leftJoin( QueryBuilder::select(['deliveryhour', 'noorders'])->from('shipping_job')
        ->groupBy('noorders')->orderBy('daterequest'),
        'sj', ['sj.noorders' => 'o.no'])
    ->where([
        's.location' => 'STG',
        Expr::orX(
            Expr::equals('vSaw.SawCompleted', false),
            Expr::andX(
                Expr::equals('metalPlateDone', false),
                Expr::notEqual('type', 'w'),
                Expr::equals('vIsAuto', false)
            )
        )
    ])
    ->groupBy('USERID')
    ->orderBy([
        Func::if(Expr::isNull('saw_startedAt'), 1, 0),
        'saw_startedAt', 'prod', 'request',
        Func::if(Expr::isNull('sj.deliveryhour'), 1, 0),
        'sj.deliveryhour', 'o.no',
        Expr::cast(
            Func::substringIndex(Expr::Column('USERID'), '-', -1),
            'UNSIGNED'
        )
    ]);
```
