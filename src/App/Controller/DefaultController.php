<?php

namespace App\Controller;

use Framework\Controller\Controller;

/**
 * Class DefaultController
 * @package App\Controller
 */
class DefaultController extends Controller
{
    /**
     * Welcome action
     */
    public function indexAction()
    {
        $rootDir = $this->container['app.root_dir'];

        return $this->render('default/index.html.php', [
            'root_dir' => $rootDir
        ]);
    }
}
