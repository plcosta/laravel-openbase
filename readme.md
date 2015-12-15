## Laravel Openbase (OpenSQL) Database Package

### OpenBase (updated for 5.1)

Openbase is an Openbase Database Driver package for [Laravel Framework](http://laravel.com/). Thanks OpenBase Sistemas (http://www.openbase.com.br)

**Please report any bugs you may find.**

- [Installation](#installation)
- [Basic Usage](#basic-usage)
- [License](#license)

### Installation

Add `plcosta/openbase` as a requirement to composer.json:

```json
{
    "require": {
        "plcosta/openbase": "0.1.*"
    }
}
```
And then run `composer update`

Once Composer has installed or updated your packages you need to register OracleDB. Open up `config/app.php` and find
the `providers` key and add:

```php
Plcosta\Openbase\OpenSqlServiceProvider::class,
```

Finally you need to publish a configuration file by running the following Artisan command.

```terminal
$ php artisan vendor:publish
```
This will copy the configuration file to config/openbase.php

### Basic Usage
The configuration file for this package is located at 'config/openbase.php'.

Once you have configured the OracleDB database connection(s), you may run queries using the 'DB' class as normal.

```php
$results = DB::select('select * from users where id = ?', array(1));
```

The above statement assumes you have set the default connection to be the oracle connection you setup in
config/database.php file and will always return an 'array' of results.

```php
$results = DB::connection('openbase')->select('select * from ce02 where id = ?', array(1));
```

See [Laravel Database Basic Docs](http://four.laravel.com/docs/database) for more information.

### License

Licensed under the [MIT License](http://cheeaun.mit-license.org/).
