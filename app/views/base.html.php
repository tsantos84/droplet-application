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
