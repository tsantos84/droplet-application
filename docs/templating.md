Templating
==========

Droplet Framework ships with TemplatingDroplet that configure the [Symfony Templating Component][1]. By default, the
template engine will find for `php` templates at `/app/resources/views`. A simple template can be something like this:

    # /app/resources/views/base.html.php
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8" />
            <title><?php $view['slots']->output('title', 'Welcome!') ?></title>
            <?php $view['slots']->output('stylesheet') ?>
        </head>
        <body>
            <?php $view['slots']->output('_content') ?>
        </body>
    </html>

And children templates can extend `base.htm.php` template:

    # /app/resources/views/default/index.html.php
    <?php $view->extend('base.html.php') ?>
    
    <h1>Index Page</h1>

More informations about the template engine can be founded on its [official page][1] 

[1]: http://symfony.com/doc/current/components/templating/introduction.html