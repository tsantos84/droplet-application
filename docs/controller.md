# Controllers

Controllers in MVC architecture are responsible to return a response given a request. They must be any [PHP callable][1] and in must cases they are linked to a route. 

## Defining a Controller

The simplest way to link a controller to a route is configuring the RoutingDroplet and setting the `_controller` option:

```PHP
# /app/config/config.php

<?php

return [
    'routing' => [
        'home' => [
            'path' => '/hello/{name}',
            'defaults' => [
                '_controller' => function($name) {
                    return new Response(sprintf('<h1>Welcome %s</h1>', $name));
                }
            ]
        ]
    ]
];
```

Despite being simple, defining a controller with a closure is not very interesting because you cannot use services like `Templating` and `Routing`. The best way to define a controller is defining a class.

```PHP
# /app/config/config.php

<?php

return [
    'routing' => [
        'home' => [
            'path' => '/hello/{name}',
            'defaults' => [
                '_controller' => 'App\Controller\DefaultController::homeAction'
            ]
        ]
    ]
];
```

And your controller can be something like this:

```PHP
# /src/App/Controller

namespace App\Controller;

class DefaultController
{
    public function homeAction($name)
    {
        return new Response(sprintf('<h1>Welcome %s</h1>', $name));
    }
}
```

"Very nice! But, how can I use those services you talked about early?" Good question! Using services on controllers is good practice to keep your controllers thin. The services must be use to help controllers build the response. Access database, request some external API and render a template are some good examples of services. There are two ways to use services inside a controller. The first one is make your controller extend the `Framework\Controller\Controller` class.

```PHP
# /src/App/Controller

namespace App\Controller;

use Framework\Controller\Controller;

class DefaultController extends Controller
{
    public function homeAction($name)
    {
        return $this->render('home.html.php', [
            'name' => $name
        ]);
    }
}
```

The base controller can access the service container thanks to `ContainerAwareInterface` and use some usefull services to help your controller to build the response. If you want to access the container but don't want to extend the base controller, all you'll need to do is implement the `Framework\DependencyInjection\ContainerAwareInterface` interface or, for the lazy developers, only extend the `Framework\DependencyInjection\AbstractContainerAwareInterface` class. Now you can access the services directly from your controllers:

```PHP
# /src/App/Controller

namespace App\Controller;

use Framework\Controller\Controller;

class DefaultController extends Controller
{
    public function homeAction($name)
    {
        $content = $this->container['templating']->render('home.html.php', [
            'name' => $name
        ]);
    
        return new Response($content);
    }
}
```

"And the second way to access the services from controllers?" This also is a good question and we prefer to write a dedicated section to explain how can you do this. 

## Defining Controllers as a Service

All the previously methods to access the services have a bad practice: the controllers are strongly dependents of the service container. For small projects this is not a problem, but in therms of scalability and portability you can experience some issues by using this approach. Supose you want to change the framework to run your application (we hope this is not your case), naturaly others framework will use other service container systems, so you will need to refactor all your controllers and adapt them to use the new service container. Can you see the problem? "Yes, I can see. How can I void this?" Answer: defining your controllers as a service. To acomplish this you need to register a custom droplet on the application and attach your controller with its all dependencies on service container:

```PHP
# /src/App/Droplet/AppDroplet

<?php 

namespace App\Droplet;

use App\Controller\DefaultController;
use Framework\Droplet\AbstractDroplet;
use Pimple\Container;

class AppDroplet extends AbstractDroplet
{
    public function buildContainer(array $configs, Container $container)
    {
        $container['controller.default'] = function($c) {
            return new DefaultController($c['templating']);
        };
    }

    public function getName()
    {
        return 'app';
    }
}
```

And now you can register the newlly droplet to your application:

```PHP
# /app/MyApp

<?php 

use Framework\Application

class MyApp extends Application
{
    public function registerDroplets()
    {
        $this->registerDroplet(new App\Droplet\AppDroplet());
    }
}
```

After this little configuration your `DefaultController` is much thin and use only it really need to build the response:

```PHP
# /src/App/Controller

namespace App\Controller;

use Framework\Controller\Controller;
use Symfony\Component\Templating\EngineInterface;

class DefaultController
{
    private $templating;

    public function __construct(EngineInterface $templating)
    {
        $this->templating = $templating;
    }

    public function homeAction($name)
    {
        $content = $this->templating->render('home.html.php', [
            'name' => $name
        ]);
    
        return new Response($content);
    }
}
```

Almost there! With your controller defined as a service, you need to tell the router to use the service name instead of the FQN class:

```PHP
# /app/config/config.php

<?php

return [
    'routing' => [
        'home' => [
            'path' => '/hello/{name}',
            'defaults' => [
                '_controller' => '@controller.default::indexAction'
            ]
        ]
    ]
];
```

[1]: http://php.net/manual/pt_BR/language.types.callable.php
