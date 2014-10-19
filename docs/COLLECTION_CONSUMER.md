Collection consumer
===
The collection consumer is used to interact with collection-type endpoints.

Each method below returns a PHP array equivalent to the JSON data returned by the API, unless stated otherwise.

Get
---
### Definition

```php
public function get($id)
```

The *get* method fetches detailed information about one or more element of the collection. It accepts a single ID or an array of IDs.

There is no limit to the size of the array passed in parameter, as a batch request will automatically be built if the number of IDs exceed the limit of the API. However, if you wish to retrieve detailed information about all the elements of the collection, see the *getAll* method.

### Returns
For an array of 200 or less IDs, this method returns a PHP array equivalent to the JSON data returned by the API.

For an array of more than 200 IDs, it returns an [iterator](http://php.net/manual/en/class.iterator.php) on arrays containing the data for one element of the collection.

### Example
```php
use Crystalgorithm\DurmandScriptorium\Facade as DurmandScriptorium;
require 'vendor/autoload.php';

$api = new DurmandScriptorium();

// Retrieve a single item
$item = $api->items()->get(80);

// Retrieve the price of multiple items
$ids = [80, 81, 100];
$prices = $api->prices()->get($ids);

// Don't forget the quaggans!
$quaggan = $api->quaggans()->get('hat');
```

The above snippet of code will return the following results:
```php
// $item
array (size=13)
  'name' => string 'Nika's Mask' (length=11)
  'description' => string '' (length=0)
  'type' => string 'Armor' (length=5)
  'level' => int 80
  'rarity' => string 'Exotic' (length=6)
  'vendor_value' => int 330
  'default_skin' => int 95
  'game_types' =>
    array (size=4)
      0 => string 'Activity' (length=8)
      1 => string 'Dungeon' (length=7)
      2 => string 'Pve' (length=3)
      3 => string 'Wvw' (length=3)
  'flags' =>
    array (size=2)
      0 => string 'HideSuffix' (length=10)
      1 => string 'SoulBindOnUse' (length=13)
  'restrictions' =>
    array (size=0)
      empty
  'id' => int 80
  'icon' => string 'https://render.guildwars2.com/file/65A0C7367206E6CE4EC7C8CBE07EABAE0191BFBA/561548.png' (length=86)
  'details' =>
    array (size=7)
      'type' => string 'Helm' (length=4)
      'weight_class' => string 'Medium' (length=6)
      'defense' => int 97
      'infusion_slots' =>
        array (size=0)
          empty
      'infix_upgrade' =>
        array (size=1)
          'attributes' =>
            array (size=3)
              ...
      'suffix_item_id' => int 24703
      'secondary_suffix_item_id' => string '' (length=0)

// $prices
array (size=3)
  0 =>
    array (size=3)
      'id' => int 80
      'buys' =>
        array (size=2)
          'quantity' => int 123
          'unit_price' => int 45924
      'sells' =>
        array (size=2)
          'quantity' => int 55
          'unit_price' => int 60905
  1 =>
    array (size=3)
      'id' => int 81
      'buys' =>
        array (size=2)
          'quantity' => int 662
          'unit_price' => int 12
      'sells' =>
        array (size=2)
          'quantity' => int 384
          'unit_price' => int 112
  2 =>
    array (size=3)
      'id' => int 100
      'buys' =>
        array (size=2)
          'quantity' => int 103
          'unit_price' => int 52599
      'sells' =>
        array (size=2)
          'quantity' => int 15
          'unit_price' => int 91929

// $quaggan
array (size=2)
  'id' => string 'hat' (length=3)
  'url' => string 'https://static.staticwars.com/quaggans/hat.jpg' (length=46)
```

### Throws
*InvalidArgumentException* when requesting a negative non-string ID. This exception will be thrown before any request to the API has been sent.

*BadRequestException* when fetching an inexistent ID. Exception to this is the Quaggans endpoint, which will return an empty array when fetching an inexistent ID.

Finally, requesting a bad ID in an array of IDs will simply cause the invalid one to be ignored, and will never throw an exception.

GetAll
------
### Definition

```php
public function getAll($expanded = false)
```

The *getAll* method has two modes of operation. Without parameters, it will return all the IDs of the elements in the collection.

However, by specifying *$expanded = true*, it will instead return the detailed information about each and every element in the collection. Batch requests will be automatically built and sent in parallel to get the data as fast as possible. There is no guaranty on the order of the elements when using *getAll(true)*.

### Returns
When retrieving all the IDs, this method returns a PHP array equivalent to the JSON data returned by the API.

When fetching the detailed information on each element of the collection, it returns an [iterator](http://php.net/manual/en/class.iterator.php) on arrays containing the data for one element of the collection.

### Example
```php
use Crystalgorithm\DurmandScriptorium\Facade as DurmandScriptorium;
require 'vendor/autoload.php';

$api = new DurmandScriptorium();

// Get all the quaggans' IDs
$quaggansIds = $api->quaggans()->getAll();

// Get the detailed listings for all the items on the trading post
$allListings = $api->listings()->getAll(true);

foreach ($allListings as $listings)
{
    // process the listings for each item
}
```

The above snippet of code will return the following results:
```php
// $quaggansIds
array (size=35)
  0 => string '404' (length=3)
  1 => string 'aloha' (length=5)
  2 => string 'attack' (length=6)
  3 => string 'bear' (length=4)
  4 => string 'bowl' (length=4)
  5 => string 'box' (length=3)
  6 => string 'breakfast' (length=9)
  7 => string 'bubble' (length=6)
  8 => string 'cake' (length=4)
  9 => string 'cheer' (length=5)
  10 => string 'coffee' (length=6)
  11 => string 'construction' (length=12)
  12 => string 'cow' (length=3)
  13 => string 'cry' (length=3)
  14 => string 'elf' (length=3)
  15 => string 'ghost' (length=5)
  16 => string 'girl' (length=4)
  17 => string 'hat' (length=3)
  18 => string 'helmut' (length=6)
  19 => string 'hoodie-down' (length=11)
  20 => string 'hoodie-up' (length=9)
  21 => string 'killerwhale' (length=11)
  22 => string 'knight' (length=6)
  23 => string 'lollipop' (length=8)
  24 => string 'lost' (length=4)
  25 => string 'moving' (length=6)
  26 => string 'party' (length=5)
  27 => string 'present' (length=7)
  28 => string 'quaggan' (length=7)
  29 => string 'rain' (length=4)
  30 => string 'scifi' (length=5)
  31 => string 'seahawks' (length=8)
  32 => string 'sleep' (length=5)
  33 => string 'summer' (length=6)
  34 => string 'vacation' (length=8)

/* Example only features the first iteration of the foreach-loop */
// $listings
array (size=3)
  'id' => int 24
  'buys' =>
    array (size=30)
      0 =>
        array (size=3)
          'listings' => int 1
          'unit_price' => int 1105
          'quantity' => int 3
      more elements...
  'sells' =>
    array (size=7)
      0 =>
        array (size=3)
          'listings' => int 1
          'unit_price' => int 50000
          'quantity' => int 58
      more elements...
```

### Throws
Never. However, PHP could potentially timeout if the *set_time_limit* and *ini_set* methods aren't supported on your server.

GetPage
-------
### Definition

```php
public function getPage($page, $pageSize = null)
```

The *getPage* method fetches detailed information about a page of elements of the collection.

To get the first and last page number for a given page size, use the *getPageRange* method.

To get all pages as quickly and efficiently as possible, use the *getAll(true)* method. You should only use *getPage* to fetch all pages if you have memory or timeout issues with *getAll*.

The page size parameter is optional. It will default to 50. The maximum value allowed is 200.

### Example
```php
use Crystalgorithm\DurmandScriptorium\Facade as DurmandScriptorium;
require 'vendor/autoload.php';

$api = new DurmandScriptorium();

// Fetch items - page 5. Page size defauts to 50.
$fiftyItems = $api->items()->getPage(5);

// Fetch items - page 0, page size 100.
$hundredItems = $api->items()->getPage(0, 100);
```

The above snippet of code will return the following results:
```php
// $fiftyItems
array (size=50)
  0 =>
    array (size=13)
        ...
    more elements...

// $hundredItems
array (size=100)
  0 =>
    array (size=13)
        ...
    more elements...
```

### Throws
*BadRequestException* when using an invalid page size or fetching an invalid page number.

GetPageRange
-------
### Definition

```php
public function getPageRange($pageSize = null)
```

The *getPageRange* method fetches the first and last page number for a given page size. Use it in conjunction with the *getPage* method to fetch all pages one by one.

The returned array contains two indexes : *first* and *last*, who contain the first and last page number for the page size given in parameter.

The page size parameter is optional. It will default to 50. The maximum value allowed is 200.

### Example
```php
use Crystalgorithm\DurmandScriptorium\Facade as DurmandScriptorium;
require 'vendor/autoload.php';

$api = new DurmandScriptorium();

$pageSize = 5;
$pageRange = $api->quaggans()->getPageRange($pageSize);

for ($currentPage = $pageRange['first']; $currentPage <= $pageRange['last']; $currentPage++)
{
    // Process the pages one by one
    $pageOfQuaggans = $api->quaggans()->getPage($currentPage, $pageSize);
}
```

The above snippet of code will return the following results:
```php
/* Example only features the first iteration of the for-loop */
// $pageOfQuaggans
array (size=5)
  0 =>
    array (size=2)
      'id' => string '404' (length=3)
      'url' => string 'https://static.staticwars.com/quaggans/404.jpg' (length=46)
  1 =>
    array (size=2)
      'id' => string 'aloha' (length=5)
      'url' => string 'https://static.staticwars.com/quaggans/aloha.jpg' (length=48)
  2 =>
    array (size=2)
      'id' => string 'attack' (length=6)
      'url' => string 'https://static.staticwars.com/quaggans/attack.jpg' (length=49)
  3 =>
    array (size=2)
      'id' => string 'bear' (length=4)
      'url' => string 'https://static.staticwars.com/quaggans/bear.jpg' (length=47)
  4 =>
    array (size=2)
      'id' => string 'bowl' (length=4)
      'url' => string 'https://static.staticwars.com/quaggans/bowl.jpg' (length=47)
```

### Throws
Never. Invalid page sizes will be ignored and defaulted to 50.
