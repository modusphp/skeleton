<?php

namespace AppConfig\ADR;

use Aura\Di;

/**
 * Set up the setters and other parameters passed into actions.
 *
 * Class Action
 * @package AppConfig\ADR
 */
class Domain extends Di\Config
{

    public function define(Di\Container $di)
    {

        /**
         * This is the basic configuration for the base database model.
         */
        $di->setter['Modus\Common\Model\Storage\Database']['setConnectionLocator'] =
            $di->lazyNew('Aura\Sql\ConnectionLocator');

        $di->setter['Modus\Common\Model\Storage\Database']['setQueryFactory'] =
            $di->lazyNew('Aura\SqlQuery\QueryFactory');

        /**
         * Configure your model-specific arguments here.
         */
    }
}
