```php
use Crystalgorithm\DurmandScriptorium\Facade as DurmandScriptorium;

require 'vendor/autoload.php';
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