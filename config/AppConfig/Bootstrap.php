<?php

namespace AppConfig;

use Aura\Di;
use Zend\Diactoros\ServerRequest;
use Zend\Diactoros\ServerRequestFactory;

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
            'router' => $di->lazyNew('Modus\Route\Manager'),
            'handler' => $di->lazyNew('Modus\ErrorLogging\Manager'),
            'responseManager' => $di->lazyNew('Modus\Response\ResponseManager'),
            'serverRequest' => ServerRequestFactory::fromGlobals(),
        );
    }
}
