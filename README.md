# QueBee: A PHP SQL Query Builder

```
            ███████╗ ██╗   ██╗███████╗                               ...vvvv)))))).
            ██╔═══██╗██║   ██║██╔════╝    /~~\               ,,,c(((((((((((((((((/
            ██║██╗██║██║   ██║█████╗     /~~c \.         .vv)))))))))))))))))))\``
            ███████╔╝██║   ██║██╔══╝         G_G__   ,,(((KKKK//////////////'
             ╚═██╔═╝ ╚██████╔╝███████╗     ,Z~__ '@,gW@@AKXX~MW,gmmmz==m_.
               ╚═╝    ╚═════╝ ╚══════╝    iP,dW@!,A@@@@@@@@@@@@@@@A` ,W@@A\c
            ██████╗ ███████╗███████╗       ]b_.__zf !P~@@@@@*P~b.~+=m@@@*~ g@Ws.
            ██╔══██╗██╔════╝██╔════╝          ~`    ,2W2m. '\[ ['~~c'M7 _gW@@A`'s
            ██████╦╝█████╗  █████╗              v=XX)====Y-  [ [    \c/*@@@*~ g@@i
            ██╔══██╗██╔══╝  ██╔══╝             /v~           !.!.     '\c7+sg@@@@@s.
            ██████╦╝███████╗███████╗          //              'c'c       '\c7*X7~~~~
            ╚═════╝ ╚══════╝╚══════╝         ]/                 ~=Xm_       '~=(Gm_.
```

![Project Language](https://img.shields.io/static/v1?label=language&message=php&color=purple)
![Project Type](https://img.shields.io/static/v1?label=type&message=library&color=red)
![Stable Version](https://img.shields.io/static/v1?label=stable-version&message=v2.0.0&color=brightgreen)
![Latest Version](https://img.shields.io/static/v1?label=latest-version&message=v2.0.0&color=yellow)
![Maintained](https://img.shields.io/static/v1?label=maintained&message=yes&color=red)
![License](https://img.shields.io/static/v1?label=license&message=MIT&color=orange)
[![PRs Welcome](https://img.shields.io/badge/PRs-welcome-brightgreen.svg)](https://github.com/hind-sagar-biswas/quebee/pulls)

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

## Features

QueBee provides following features to work with MySQL:

1. **Queries:** `Query` class for `SELECT`, `INSERT`, `UPDATE`, and `DELETE` queries.
2. **Table:** `Table` class for `CREATE TABLE` along with `Col` class for columns.
3. **Columns:** `Col` class has a bunch of datatypes like `INT`, `VARCHAR`, `DATETIME` and many more for creating columns as per your requirements.
4. **Statements:** `Stmt` class for `UNION`, `UNION ALL`, `CUBE`, `SET`, and `GROUPING SETS` statements.

It also includes foreign key constraints, unique, primary key and indexing as well as grouping. See the `/tests/` directory for all possible ways of using the `QueBee`;

## Usage

Below are examples of how to use each query builder.

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
    ->where('column1', 'value')
    ->orderBy('column2', 'desc')
    ->limit(10)
    ->build();

// Resulting SQL query
// SELECT column1, column2 FROM table WHERE column1 = 'value' ORDER BY column2 DESC LIMIT 0, 10;
```

#### condition aliases for conditional statements

| SQL | Literal | Symbolic |
|----------|---------|---------|
| `>`      | `gt`    | `>`     |
| `>=`     | `gte`   | `>=`    |
| `<`      | `lt`    | `<`     |
| `<=`     | `lte`   | `<=`    |
| `=`      | `eq`    | `==` or `=` |
| `!=`     | `ne`    | `!=` or `<>` |
| `<=>`    | `ns`    | `<=>`   |
| `LIKE`   | `like`  | `??`    |

You can use either Literal or Symbolic.


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
    ->where('column1', 'value1')
    ->build();

// Resulting SQL query
// UPDATE table SET column1 = 'new_value1', column2 = 'new_value2' WHERE column1 = 'value1';
```

### 4. DELETE Queries

To create a `DELETE` query, use the `Query::delete()` method:

```php
$query = Query::delete('table')->where('column1', 1, 'gt')->build() // Here `gt` is alias for `>`

// Resulting SQL query
// DELETE FROM table WHERE column1 > '1';
```

### 5. CREATE TABLE Queries

To create a `CREATE TABLE` query, use the `Table::create()` method:

#### Without Any Foreign Keys

```php
use Hindbiswas\QueBee\Col;
use Hindbiswas\QueBee\Table;
use Hindbiswas\QueBee\Table\Values\DefaultVal;

$usersTable = Table::create('users')->columns([
    'id' => Col::integer(11)->unsigned()->pk()->ai(),
    'username' => Col::varchar()->unique(),
    'email' => Col::varchar()->unique(),
    'password' => Col::varchar(),
    'is_superadmin' => Col::integer(2)->default('0'),
    'create_time' => Col::dateTime()->default(DefaultVal::CURRENT_TIME),
    'update_time' => Col::dateTime()->setOnUpdate()->default(DefaultVal::CURRENT_TIME),
]);

$query = $usersTable->build();

// Resulting SQL query
// CREATE TABLE IF NOT EXISTS users (`id` INT(11) UNSIGNED NULL AUTO_INCREMENT, `username` VARCHAR(255) NOT NULL, `email` VARCHAR(255) NOT NULL, `password` VARCHAR(255) NOT NULL, `is_superadmin` INT(2) NOT NULL DEFAULT '0', `create_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, `update_time` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, CONSTRAINT users_PK PRIMARY KEY (id), CONSTRAINT username_UC UNIQUE (`username`), CONSTRAINT email_UC UNIQUE (`email`)) ENGINE = InnoDB;
```

#### With Foreign Keys

```php
use Hindbiswas\QueBee\Col;
use Hindbiswas\QueBee\Table;
use Hindbiswas\QueBee\Table\Values\DefaultVal;
use Hindbiswas\QueBee\Table\Values\FK;

// $usersTable = create a table to constrain with

$table = Table::create('tokens')->columns([
    'id' => Col::integer()->unsigned()->pk()->ai(),
    'selector' => Col::varchar(),
    'hashed_validator' => Col::varchar(),
    'user_id' => Col::integer(11)->unsigned(),
    'expiry' => Col::dateTime(),
])->foreign('user_id')->onDelete(FK::CASCADE)->reference($usersTable, 'id');

// Resulting SQL query
// CREATE TABLE IF NOT EXISTS tokens (`id` INT UNSIGNED NULL AUTO_INCREMENT, `selector` VARCHAR(255) NOT NULL, `hashed_validator` VARCHAR(255) NOT NULL, `user_id` INT(11) UNSIGNED NOT NULL, `expiry` DATETIME NOT NULL, CONSTRAINT tokens_PK PRIMARY KEY (id), FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE) ENGINE = InnoDB;
```

#### Available Data Types as of `v1.2.0`

- String
  - TEXT => `Col::text()`
  - VARCHAR => `Col::varchar(225)`
- Numeric
  - BIT => `Col::bit()`
  - INT => `Col::integer()`
  - BIGINT => `Col::bigInt()`
  - MEDIUMINT => `Col::mediumInt()`
  - SMALLINT => `Col::smallInt()`
  - TINYINT => `Col::tinyInt()`
  - DECIMAL => `Col::decimal(11, 6)`
  - FLOAT => `Col::float(6, 2)`
  - DOUBLE => `Col::double(11, 6)`
  - REAL => `Col::real(11, 6)`
- Time
  - DATE => `Col::date()`
  - DATETIME => `Col::dateTime()`

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
