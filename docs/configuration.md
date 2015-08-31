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
/web/index.php
<?php

use Symfony\Component\HttpFoundation\Request;

require '../vendor/autoload.php';
require '../app/MyApp.php';

$request = Request::createFromGlobals();

$app      = new MyApp('prod');
$response = $app->handle($request);
$response->send();
```

And to load the configuration for development environment, you only need to change the first argument when instantiating
the `MyApp` class.

```PHP
/web/index_dev.php
<?php

...

$app = new MyApp('dev');

...

```

The downside of this approach is that you need to have two files configuration (e.g: `config_prod.php` and `config_dev.php`).
To avoid that kind of duplication, Droplet Framework has a file loader that can import other files defined on the configuration file
loaded by application:

```PHP
/app/config/config_prod.php
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
/app/config/config_dev.php
<?php

return [
    '@import' => 'config_prod.php',
    'templating' => [
        ...
    ]
];
```

As you can see, the development environment imports all the configuration defined in production. The key `@import` is
reserved and will be remove from the final configuration. You can also separate each droplet configuration on its own
file configuration:

```PHP
/app/config/config_prod.php
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
