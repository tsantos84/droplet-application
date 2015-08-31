# Templating

Droplet Framework ships with TemplatingDroplet that configures the [Symfony Templating Component][1] to run with your 
application. 


## Configuration

By default, the template engine will look for `.php` templates at `/app/resources/views`. Of course, your
can change or add more paths to engine:

```PHP
# /app/config/config.php
<?php

return [
    ...
    'templating' => [
        'paths' => [
            __DIR__ . '/../resources/views',
            __DIR__ . '/../../src/App/Resources/views
        ]
    ]
    ...
]
```

## Rendering

TemplatingDroplet will register in service container the engine responsible to render the `php` templates. Once you have
access to the service container, you can render your brilliant template:

```PHP
<?php

$container['templating']->render('index.html.php', [
    'username' => 'Tales Santos'
]);
```

And your template will looks like:

```PHP
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Hello <?php echo $username ?></title>
    </head>
    <body>
        <h1>Hello <?php echo $username ?>!</h1>
    </body>
</html>
```

## Helpers

By default, the template engine do not more than render templates and return its content. To add extra functionality to 
template engine you can register `Helpers` and use them inside your templates.

### SlotsHelper

The SlotsHelper provide a simple way to reuse some HTML fragments like `headers` and `footers`. Take a look at the 
[official helper documentation][2] to obtain more detailed information.  

## Global Variables

Sometimes you need to pass variables to all templates. You can accomplish this by setting the `globals` option on 
your configuration file:

```PHP
# /app/config/config.php
<?php

return [
    ...
    'templating' => [
        'globals' => [
            'ga_tracking' => 'UA-xxxxxx-x'
        ]
    ]
    ...
]
```

## More Information

More information about the template engine can be founded on its [official page][1]. In there you can find how to [escape 
output variables][3] to prevent XSS attacks, [include other templates][4] and more. 

[1]: http://symfony.com/doc/current/components/templating/introduction.html
[2]: http://symfony.com/doc/current/components/templating/helpers/slotshelper.html
[3]: http://symfony.com/doc/current/components/templating/introduction.html#output-escaping
[4]: http://symfony.com/doc/current/components/templating/introduction.html#including-templates