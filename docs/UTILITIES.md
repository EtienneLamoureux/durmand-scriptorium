Utilities
===
Utilities are miscellaneous functionalities provided by Durmand Scriptorium to get the most out of the Guild Wars 2 API.

Localization
---
### Definition
```php
public function setLocale($localeCode)
```

The localization utilities populate the information coming from the API with strings translated in the specified locale.  The default locale is English. For a complete list of the supported ISO 639-1 codes to pass to this function, see *Crystalgorithm\DurmandScriptorium\utils\Locale*.

### Supported locales
- English
- Español
- Deutsch
- Français
- 한국어 (Hangugeo)
- 中文 (Zhōngwén)

### Example
```php
<?php

use Crystalgorithm\DurmandScriptorium\Facade as DurmandScriptorium;
use Crystalgorithm\DurmandScriptorium\utils\Locale;

require 'vendor/autoload.php';

// Setup initial locale to use for all API calls
// Those two lines are equivalent
$api = new DurmandScriptorium(Locale::FRENCH);
$api = new DurmandScriptorium('fr'); // ISO 639-1 code

// You can also change the locale on the fly
// Again, both these lines are equivalent
$api->setLocale(Locale::GERMAN);
$api->setLocale('de'); // ISO 639-1 code
```
###Throws
*UnexpectedValueException* if given an unsupported locale code

