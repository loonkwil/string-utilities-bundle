# Installálás

composer.json fájlba:
```
"repositories": [
    ...
    {
        "type": "vcs",
        "url": "https://github.com/loonkwil/string-utilities.git"
    },
    ...
],
"require": {
    ...
    "spe/string-utilities": "dev-master",
    ...
}
```

```
php composer.phar update
```

app/AppKernel.php fájlba:
```
$bundles = array(
    // ...
    new SPE\StringUtilitiesBundle\SPEStringUtilitiesBundle(),
    // ...
);
```

# Használata

controller rétegben:

```
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
