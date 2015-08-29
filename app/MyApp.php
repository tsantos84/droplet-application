<?php

use Framework\Application;
use Framework\Droplet\Core\KernelDroplet;
use Framework\Droplet\Core\RoutingDroplet;
use Framework\Droplet\Core\SessionDroplet;
use Framework\Droplet\Core\TemplatingDroplet;

/**
 * Class MyApp
 */
class MyApp extends Application
{
    /**
     * Register all droplets necessary to run your application
     */
    public function registerDroplets()
    {
        $this->registerDroplet(new KernelDroplet());
        $this->registerDroplet(new RoutingDroplet());
        $this->registerDroplet(new TemplatingDroplet());
        $this->registerDroplet(new SessionDroplet());
    }

}