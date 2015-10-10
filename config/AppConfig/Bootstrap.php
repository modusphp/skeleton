<?php

namespace AppConfig;

use Aura\Di;

/**
 * Set up the setters and other parameters passed into actions.
 *
 * Class Action
 * @package AppConfig\ADR
 */
class Bootstrap extends Di\Config
{
    public function define(Di\Container $di)
    {
        $di->params['Modus\Application\Bootstrap'] = array(
            'config' => $di->lazyGet('config'),
            'di' => $di,
            'authService' => $di->lazyNew('Modus\Auth\Service'),
            'router' => $di->lazyNew('Modus\Router\RouteManager'),
            'handler' => $di->lazyNew('Modus\ErrorLogging\Manager'),
            'responseManager' => $di->lazyNew('Modus\Response\ResponseManager'),
        );
    }
}
