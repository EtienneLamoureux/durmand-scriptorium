Converter consumer
===
The converter consumer is used to interact with converter-type endpoints.

Each method below returns a PHP array equivalent to the JSON data returned by the API.

N.B.: The amount of coins is always expressed in copper.

Convert
---
### Definition

```php
public function convert($quantity)
```

The *convert* method converts an amount of currency and get the current exchange rate.

### Example
```php
use Crystalgorithm\DurmandScriptorium\Facade as DurmandScriptorium;
require 'vendor/autoload.php';

$api = new DurmandScriptorium();

// Get the amount of coins obtained for 100 gems
$coins = $api->gems()->convert(100);
```

The above snippet of code will return the following results:
```php
// $coins
array (size=2)
  'coins_per_gem' => int 963
  'quantity' => int 96386
```

### Throws
*BadRequestException* when an insufficient amount of currency is used (quantity lower than the exchange rate).
