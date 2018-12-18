<?php

namespace AppConfig;

use Aura\Di\Config;
use Aura\Di\Container;
use Aura\Router\RouterContainer;
use Modus\Route\Manager;

class Router extends Config
{

    public function define(Container $di)
    {
        $di->params[Manager::class] = [
            'container' => $di->lazyNew(RouterContainer::class)
        ];

        $config = $di->get('config');
        $config = $config->getConfig();

        $di->setters[Manager::class]['loadRoutes'] = require($config['root_path'] . '/config/routes.php');


    }
}
