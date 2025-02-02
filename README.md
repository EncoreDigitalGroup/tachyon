# EncoreDigitalGroup/Tachyon

## Installation

Run the following command in your terminal:

```bash
composer require encoredigitalgroup/tachyon
```

Then add the following to your application code:

```php
use EncoreDigitalGroup\Tachyon\Tachyon;

Tachyon::loadMixin();
```

The above code will apply the Tachyon mixins to both `Carbon` and `CarbonImmutable`

If you are using Laravel, this can be done in any Service Provider.

## Upgrading to Version 3.0

As of Version 3.0, Tachyon is a mixin for `nesbot/carbon`. Direct using of Tachyon directly in your code is no longer encouraged.
Instead you should use the example code from the installation section to load the mixin code into the appropriate `Carbon` classes.

