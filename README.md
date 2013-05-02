# String Utilites Bundle

String muveletekkel kapcsolatos fuggveneket tartalmazo Symfony 2.x bundle.

## Installálás

composer.json fájlba:
```json
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/loonkwil/string-utilities-bundle.git"
    },
],
"require": {
    "spe/string-utilities": "dev-master",
}
```

```bash
php composer.phar update
```

### Symfony 2.x

```php
// app/AppKernel.php

$bundles = array(
    // ...
    new SPE\StringUtilitiesBundle\SPEStringUtilitiesBundle(),
    // ...
);
```

### Silex

```php

use SPE\StringUtilitiesBundle\StringUtilities;

$app['su'] = $app->share(
    return new StringUtilities();
);
```

## Használata

### Symfony 2.x

controller rétegben:

```php
<?php

// ...

class DefaultController extends Controller
{
    public function listAction(Request $request)
    {
        $su = $this->get('string_utilities');

        $password = $su->getRandomString(10, true, true);

        // ...
    }
}
```

### Silex

```php
<?php

$app['controllers']->get('/list', function() use ($app) {
    $password = $app['su']->getRandomString(10, true, true);

    // ...
});
```
