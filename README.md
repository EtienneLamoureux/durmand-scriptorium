Durmand Scriptorium
===================
[![Build Status](https://travis-ci.org/EtienneLamoureux/durmand-scriptorium.svg)](https://travis-ci.org/EtienneLamoureux/durmand-scriptorium)
[![Coverage Status](https://img.shields.io/coveralls/EtienneLamoureux/durmand-scriptorium.svg)](https://coveralls.io/r/EtienneLamoureux/durmand-scriptorium)
[![Dependency Status](https://www.versioneye.com/user/projects/54276b2175d3727f13000228/badge.svg)](https://www.versioneye.com/user/projects/54276b2175d3727f13000228)
[![Latest Stable Version](https://poser.pugx.org/crystalgorithm/durmand-scriptorium/v/stable.svg)](https://packagist.org/packages/crystalgorithm/durmand-scriptorium)
[![Latest Unstable Version](https://poser.pugx.org/crystalgorithm/durmand-scriptorium/v/unstable.svg)](https://packagist.org/packages/crystalgorithm/durmand-scriptorium)
[![License](https://poser.pugx.org/crystalgorithm/durmand-scriptorium/license.svg)](https://packagist.org/packages/crystalgorithm/durmand-scriptorium)

PHP package to consume the Guild Wars 2 API

Installation
------------
### Via Composer

The recommended way to install Durmand Scriptorium is through
[Composer](http://getcomposer.org).

Add Durmand Scriptorium to your project's composer.json file:

```javascript
{
    "require": {
        "crystalgorithm/durmand-scriptorium": "~1.0"
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
- [PHPUnit](https://github.com/sebastianbergmann/phpunit) [dev only] - The PHP Unit Testing framework.
- [Mockery](https://github.com/padraic/mockery) [dev only] - Simple yet flexible PHP mock object framework.

Documentation
-------------
- Supported endpoints
    - Quaggans
    - Items
    - Listings
    - Prices
    - Coins
    - Gems
- Collection consumer
    - Get
    - GetAll
    - GetPage
- Converter consumer
    - Convert

License
-------
[BSD 3-Clause](https://github.com/EtienneLamoureux/DurmandScriptorium/blob/master/LICENSE)