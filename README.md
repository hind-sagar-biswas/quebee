# QueBee: A PHP SQL Query Builder

```
            ██████╗░██╗░░░██╗███████╗                               ...vvvv)))))).
            █╔═══██╗██║░░░██║██╔════╝    /~~\               ,,,c(((((((((((((((((/
            █║██╗██║██║░░░██║█████╗░░   /~~c \.         .vv)))))))))))))))))))\``
            ██████╔╝██║░░░██║██╔══╝░░       G_G__   ,,(((KKKK//////////////'
            ╚═██╔═╝░╚██████╔╝███████╗     ,Z~__ '@,gW@@AKXX~MW,gmmmz==m_.
            ░░╚═╝░░░░╚═════╝░╚══════╝    iP,dW@!,A@@@@@@@@@@@@@@@A` ,W@@A\c
            █████╗░███████╗███████╗       ]b_.__zf !P~@@@@@*P~b.~+=m@@@*~ g@Ws.
            █╔══██╗██╔════╝██╔════╝          ~`    ,2W2m. '\[ ['~~c'M7 _gW@@A`'s
            █████╦╝█████╗░░█████╗░░            v=XX)====Y-  [ [    \c/*@@@*~ g@@i
            █╔══██╗██╔══╝░░██╔══╝░░           /v~           !.!.     '\c7+sg@@@@@s.
            █████╦╝███████╗███████╗          //              'c'c       '\c7*X7~~~~
            ═════╝░╚══════╝╚══════╝         ]/                 ~=Xm_       '~=(Gm_.
```

![Project Language](https://img.shields.io/static/v1?label=language&message=php&color=purple)
![Project Type](https://img.shields.io/static/v1?label=type&message=library&color=red)
![Stable Version](https://img.shields.io/static/v1?label=stable-version&message=v1.0.0&color=brightgreen)
![Maintained](https://img.shields.io/static/v1?label=maintained&message=yes&color=red)
![License](https://img.shields.io/static/v1?label=license&message=MIT&color=orange)
[![PRs Welcome](https://img.shields.io/badge/PRs-welcome-brightgreen.svg)](http://makeapullrequest.com)

## Introduction

The QᴜᴇᴇBᴇᴇ (QB) or Query Builder package is a lightweight package for Building MySQL Queries.
It is a PHP package that simplifies the construction of SQL queries. It provides an object-oriented approach to building SQL queries, making it easier to create, modify, and execute SQL statements in your PHP applications.

## Installation

### 1. Composer

QueBee can be installed via Composer, a PHP dependency manager. If you haven't installed Composer yet, visit [composer's website](https://getcomposer.org) for instructions.

Run the following command to install QueBee:

```bash
composer require hindbiswas/quebee
```

### 2. Autoloading

Ensure that Composer's autoloader is included in your project's PHP files.
Use your path in place of `path/to/`:

```php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'path/to' . '/vendor/autoload.php';
```

## Usage

QueBee provides classes for building `SELECT`, `INSERT`, `UPDATE`, `DELETE`  and `CREATE TABLE` SQL queries. Below are examples of how to use each query builder.

### 1. SELECT Query

To create a `SELECT` query, use the `Query::select()` method:

```php
use Hindbiswas\QueBee\Query;

$aliased_cols = ['alias1' => 'column1', 'alias2' => 'column2', 'column3' => 'column3'];
$query = Query::select($aliased_cols)->from('table')->build();

// Resulting SQL query
// SELECT column1 AS alias1, column2 AS alias2, column3 AS column3 FROM table;
```

Or,

```php
use Hindbiswas\QueBee\Query;

$query = Query::select(['column1', 'column2'])
    ->from('table')
    ->where('column1', '=', 'value')
    ->orderBy('column2', 'desc')
    ->limit(10)
    ->build();

// Resulting SQL query
// SELECT column1, column2 FROM table WHERE column1 = 'value' ORDER BY column2 DESC LIMIT 0, 10;
```

### 2. INSERT Queries

To create an `INSERT` query, use the `Query::insert()` method (To insert multiple rows at once, use the `Query::insertMultiple()` method):

```php
use Hindbiswas\QueBee\Query;

$data = ['column1' => 'value1', 'column2' => 'value2'];

$query = Query::insert($data)
    ->into('table')
    ->build();

// Resulting SQL query
// INSERT INTO table (column1, column2) VALUES ('value1', 'value2');
```

### 3. UPDATE Queries

To create an `UPDATE` query, use the `Query::update()` method:

```php
use Hindbiswas\QueBee\Query;

$data = ['column1' => 'new_value1', 'column2' => 'new_value2'];

$query = Query::update('table')
    ->set($data)
    ->where('column1', '=', 'value1')
    ->build();

// Resulting SQL query
// UPDATE table SET column1 = 'new_value1', column2 = 'new_value2' WHERE column1 = 'value1';
```

### 4. DELETE Queries

To create a `DELETE` query, use the `Query::delete()` method:

```php
$query = Query::delete('table')->where('column1', '=', 1)->build()

// Resulting SQL query
// DELETE FROM table WHERE column1 = '1';
```

## Best Practices

Here are some best practices when using **QueBee**:

1. **Sanitize User Inputs:** Always sanitize user inputs before using them in queries.

2. **Error Handling:** Handle exceptions appropriately, especially when building queries. QueBee can throw exceptions for invalid input or method calls.

3. **Database Abstraction:** Consider using a database abstraction layer alongside QueBee for more extensive database interactions.

4. **Code Organization:** Organize your code logically, separating query building from execution and result handling.

## Conclusion

QueBee simplifies SQL query construction in PHP, making it easier to build clean, secure, and efficient database interactions. With its fluent API, it provides a user-friendly way to create SQL queries for various database systems.

For more detailed usage and customization options, refer to the QueBee GitHub repository.

That's it! You're ready to start using QueBee for building SQL queries in your PHP applications.
