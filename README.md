Durmand Scriptorium
===================
[![Build Status](https://secure.travis-ci.org/EtienneLamoureux/DurmandScriptorium.png?branch=master)](http://travis-ci.org/EtienneLamoureux/DurmandScriptorium)

PHP package to consume the GW2 API

Installation
------------
### Via Composer

The recommended way to install Guzzle is through
[Composer](http://getcomposer.org).

Add Durmand Scriptorium to your project's composer.json file:

```javascript
{
    "require": {
        "crystalgorithm/durmand-scriptorium": "dev-master"
    }
}
```

After installing, you need to require Composer's autoloader:

```php
require 'vendor/autoload.php';
```

### Dependencies
Durmand Scriptorium uses a number of open source projects to work properly:
- [Guzzle](https://github.com/guzzle/guzzle) - PHP HTTP client and webservice framework
- [PHPUnit](https://github.com/sebastianbergmann/phpunit) - The PHP Unit Testing framework.

Usage
-----
### Supported endpoints
Collection-type endpoints:
- Quaggans
- Items
- Listings
- Prices

### Examples
Retrieving information from the collection-type endpoints:
```php
use Crystalgorithm\DurmandScriptorium\Facade as DurmandScriptorium;

$api = new DurmandScriptorium();

// Get a single element
$api->quaggans()->get($id); // $id is a single ID

// Get many elements
$api->quaggans()->get($ids); // $ids is an array of IDs
$api->quaggans()->getPage($page, $pageSize); // N.B. the first page number is 0

// Get all elements
$api->quaggans()->getAll(); // returns all the IDs
$api->quaggans()->getAll(true); // returns detailed information about each element
```
That's it, it's as simple as that!

License
-------
[BSD 3-Clause](https://github.com/EtienneLamoureux/DurmandScriptorium/blob/master/LICENSE)