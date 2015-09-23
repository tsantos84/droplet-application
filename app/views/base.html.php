<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title><?php $view['slots']->output('title', 'Welcome!') ?></title>
        <?php $view['slots']->output('stylesheet') ?>
        <link rel="icon" type="image/x-icon" href="/favicon.ico" />
    </head>
    <body>
        <?php $view['slots']->output('_content') ?>
    </body>
</html>
