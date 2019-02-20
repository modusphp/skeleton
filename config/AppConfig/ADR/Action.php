<?php

namespace AppConfig\ADR;

use Aura\Di;
use Example\Action\Index;

/**
 * Set up the setters and other parameters passed into actions.
 *
 * Class Action
 * @package AppConfig\ADR
 */
class Action extends Di\Config
{

    public function define(Di\Container $di)
    {
        /**
         * Configure the settings for your actions here (e.g.
         * constructor arguments, setters, etc.)
         */

        $di->params[Index::class] = [
            'request' => $di->lazyGet('psr7-request'),
        ];
    }
}
