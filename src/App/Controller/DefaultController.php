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
        return $this->render('welcome.html.php');
    }
}