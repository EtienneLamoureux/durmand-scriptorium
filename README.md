Durmand Scriptorium
===================
[![Build Status](https://travis-ci.org/EtienneLamoureux/durmand-scriptorium.svg)](https://travis-ci.org/EtienneLamoureux/durmand-scriptorium)
[![Coverage Status](https://img.shields.io/coveralls/EtienneLamoureux/durmand-scriptorium.svg)](https://coveralls.io/r/EtienneLamoureux/durmand-scriptorium)
[![Dependency Status](https://www.versioneye.com/user/projects/54276b2175d3727f13000228/badge.svg)](https://www.versioneye.com/user/projects/54276b2175d3727f13000228)
[![Latest Stable Version](https://poser.pugx.org/crystalgorithm/durmand-scriptorium/v/stable.svg)](https://packagist.org/packages/crystalgorithm/durmand-scriptorium)
[![License](https://poser.pugx.org/crystalgorithm/durmand-scriptorium/license.svg)](https://packagist.org/packages/crystalgorithm/durmand-scriptorium)

PHP package to consume the Guild Wars 2 API, proudly brought to you by Keider.8652

Installation
------------
### Via Composer

The recommended way to install Durmand Scriptorium is through
[Composer](http://getcomposer.org).

Add Durmand Scriptorium to your project's composer.json file:

```javascript
{
    "require": {
        "crystalgorithm/durmand-scriptorium": "~1.3"
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
- [PHP JSON Iterator](https://github.com/EtienneLamoureux/php-json-iterator) - PHP package to iterate through various JSON formats
- [PHP Enum](https://github.com/myclabs/php-enum) - PHP Enum implementation inspired from SplEnum
- [PHPUnit](https://github.com/sebastianbergmann/phpunit) [dev only] - The PHP Unit Testing framework
- [Mockery](https://github.com/padraic/mockery) [dev only] - Simple yet flexible PHP mock object framework

Documentation
-------------
- [Supported endpoints](https://github.com/EtienneLamoureux/durmand-scriptorium/blob/master/docs/SUPPORTED_ENDPOINTS.md#supported-endpoints)
    - [Quaggans](https://github.com/EtienneLamoureux/durmand-scriptorium/blob/master/docs/SUPPORTED_ENDPOINTS.md#quaggans)
    - [Items](https://github.com/EtienneLamoureux/durmand-scriptorium/blob/master/docs/SUPPORTED_ENDPOINTS.md#items)
    - [Listings](https://github.com/EtienneLamoureux/durmand-scriptorium/blob/master/docs/SUPPORTED_ENDPOINTS.md#listings)
    - [Prices](https://github.com/EtienneLamoureux/durmand-scriptorium/blob/master/docs/SUPPORTED_ENDPOINTS.md#prices)
    - [Coins](https://github.com/EtienneLamoureux/durmand-scriptorium/blob/master/docs/SUPPORTED_ENDPOINTS.md#coins)
    - [Gems](https://github.com/EtienneLamoureux/durmand-scriptorium/blob/master/docs/SUPPORTED_ENDPOINTS.md#gems)
    - [Worlds](https://github.com/EtienneLamoureux/durmand-scriptorium/blob/master/docs/SUPPORTED_ENDPOINTS.md#worlds)
- [Collection consumer](https://github.com/EtienneLamoureux/durmand-scriptorium/blob/master/docs/COLLECTION_CONSUMER.md#collection-consumer)
    - [Get](https://github.com/EtienneLamoureux/durmand-scriptorium/blob/master/docs/COLLECTION_CONSUMER.md#get)
    - [GetAll](https://github.com/EtienneLamoureux/durmand-scriptorium/blob/master/docs/COLLECTION_CONSUMER.md#getall)
    - [GetPage](https://github.com/EtienneLamoureux/durmand-scriptorium/blob/master/docs/COLLECTION_CONSUMER.md#getpage)
    - [GetPageRange](https://github.com/EtienneLamoureux/durmand-scriptorium/blob/master/docs/COLLECTION_CONSUMER.md#getpagerange)
- [Converter consumer](https://github.com/EtienneLamoureux/durmand-scriptorium/blob/master/docs/CONVERTER_CONSUMER.md#converter-consumer)
    - [Convert](https://github.com/EtienneLamoureux/durmand-scriptorium/blob/master/docs/CONVERTER_CONSUMER.md#convert)
- [Utilities](https://github.com/EtienneLamoureux/durmand-scriptorium/blob/master/docs/UTILITIES.md#utilities)
    - [Localization](https://github.com/EtienneLamoureux/durmand-scriptorium/blob/master/docs/UTILITIES.md#localization)

License
-------
[BSD 3-Clause](https://github.com/EtienneLamoureux/DurmandScriptorium/blob/master/LICENSE)