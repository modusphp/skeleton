<?php

namespace AppConfig;

use Aura\Di;
use Zend\Diactoros\ServerRequestFactory;

/**
 * Set up the setters and other parameters passed into actions.
 *
 */
class Request extends Di\Config
{

    public function define(Di\Container $di)
    {
        $di->set('psr7-request', function() {
            return (new ServerRequestFactory())->fromGlobals();
        });
    }
}
