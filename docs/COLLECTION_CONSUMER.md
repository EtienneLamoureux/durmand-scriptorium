Collection consumer
===================
The collection consumer is used to interract with collection-type endpoints.

Each method below returns a PHP array equivalent to the JSON data returned by the API.

Get
---
### Definition

```php
public function get($id)
```

The *get* method allows to fetch detailed information about one or more element of the collection. It accepts a single ID or an array of IDs.

There is no limit to the size of the array passed in parameter, as a batch request will automatically built if the number of IDs exceed the limit of the API. However, if you wish to retreive detailed information about all the elements of the collection, the use of the *getAll* method is prefered.

### Example
```php
use Crystalgorithm\DurmandScriptorium\Facade as DurmandScriptorium;
require 'vendor/autoload.php';

$api = new DurmandScriptorium();

// Retreive a single item
$item = $api->items()->get(80);

// Retreive the price of multiple items
$ids = [80, 81, 100];
$prices = $api->prices()->get($ids);

// Don't forget the quaggans!
$quaggan = $api->quaggans()->get('hat');
```

The above snipet of code will return the following results:
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

*BadRequestException* when fetching an inexisting ID. Exception to this is the Quaggans endpoint, which will return an empty array when fetching an inexisting ID.

Finally, requesting a bad ID in an array of IDs will simply cause the invalid one to be ignored, and will never throw an exception.

GetAll
------
### Definition

```php
public function getAll($expanded = false)
```

The *getAll* method has two modes of operation. Without parameters, it will return all the IDs of the elements in the collection.

However, by specifying *$expanded = true*, it will instead returned the detailed information about each and every element in the collection. Batch requests will be automatically built and send in parallel to get the data as fast as possible. There is no garanty on the order of the elements when using *getAll(true)*.

### Example
```php
use Crystalgorithm\DurmandScriptorium\Facade as DurmandScriptorium;
require 'vendor/autoload.php';

$api = new DurmandScriptorium();

// Get all the quaggans' IDs
$quaggansIds = $api->quaggans()->getAll();

// Get the detailed listings for all the items on the trading post
$allListings = $api->listings()->getAll(true);
```

The above snipet of code will return the following results:
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

// $allListings
array (size=22151)
  0 =>
    array (size=3)
      'id' => int 279
      'buys' =>
        array (size=20)
          0 =>
            array (size=3)
              ...
            more elements...
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

The *getPage* method allows to fetch detailed information about a page of elements of the collection.

The first page number is 0. The last page number depends on the collection and the page size requested. This method won't give you this information, but if you are interested in iterating over all the pages, the *getAll* method is there just for that!

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

The above snipet of code will return the following results:
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