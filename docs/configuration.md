Configuration
=============

Droplet Application has a simple way to configure how your droplets will work. Each root key on configuration file
has all the configuration expected by the droplets registered on the application. An exception will be thrown if
the configuration file have a non registered droplet.

Creating Environment Configuration
----------------------------------

By default, the application is shipped with one file configuration (`/app/config/config.php`) which has the minimum options
necessary to run your application. But you can create different front controllers and load different environments configurations.

```PHP
# /web/index.php
<?php

use Symfony\Component\HttpFoundation\Request;

require '../vendor/autoload.php';
require '../app/MyApp.php';

$request = Request::createFromGlobals();

$app      = new MyApp();
$response = $app->handle($request);
$response->send();
```

And to load the configuration for development environment, you only need to change the first argument when instantiating
the `MyApp` class.

```PHP
# /web/index_dev.php
<?php

...

$app = new MyApp('dev');

...

```

The downside of this approach is that you will need two different files configuration (e.g: `config.php` and `config_dev.php`) and perhaps duplicate common droplet configurations. To avoid this situation, Droplet Framework has a efficient file loader that can import other files from the file loaded by the application:

```PHP
# /app/config/config_prod.php
<?php

return [
    'routing' => [
        ...
    ],
    'templating' => [
        ...
    ]
];
```

and the development will looks like:

```PHP
# /app/config/config_dev.php
<?php

return [
    '@import' => 'config_prod.php',
    'templating' => [
        ...
    ]
];
```

As you can see, the development environment imports all configurations defined in production environment and all options defined on it will be overwritten by the options defined on `config_dev.php`. Is important to know that the key `@import` is reserved and will be removed from the final configuration after the configuration process. In that way, you can even split each droplet configuration on its own file configuration:

```PHP
# /app/config/config.php
<?php

return [
    '@import' => [
        'database.php',
        'routing.php',
        'templating.php',
        ...
    ]
];
```
