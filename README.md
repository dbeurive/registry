# Description

This package implements a simple registry.

# Installation

From the command line:

    composer require dbeurive/tree

From your `composer.json` file:

```json
{
    "require": {
        "dbeurive/tree": "1.0.*"
    }
}
```

# API documentation

The detailed documentation of the API can be extracted from the code by using [PhpDocumentor](https://www.phpdoc.org/).
The file `phpdoc.xml` contains the required configuration for `PhpDocumentor`.
To generate the API documentation, just move into the root directory of this package and run `PhpDocumentor` from this location.

Note:

> Since all the PHP code is documented using PhpDoc annotations, you should be able to exploit the auto completion feature from your favourite IDE.
> If you are using Eclipse, NetBeans or PhPStorm, you probably won’t need to consult the generated API documentation.

# Synopsis

Register an entry:

```php
$value = 10;
dbeurive\Registry\Registry::register('YourEntry', $value);
```

Register an entry and declare it as constant:

```php
$value = 10;
dbeurive\Registry\Registry::register('YourEntry', $value, true);
```

Get the value of a registered entry:

```php
dbeurive\Registry\Registry::get('YourEntry');
```

Change the value of a registered entry:

```php
$newValue = 20;
dbeurive\Registry\Registry::set('YourEntry', $newValue);
```

Test if an entry is registered:

```php
if (dbeurive\Registry\Registry::isRegistered('YourEntry')) { ... }
```

Test if an entry is declared as constant:

```php
if (dbeurive\Registry\Registry::isConstant('YourEntry')) { ... }
```

# Examples

Unit tests are good examples.