<?php

namespace AppConfig\ADR;

use Aura\Di;

/**
 * Set up the setters and other parameters passed into responders.
 *
 * Class Action
 * @package AppConfig\ADR
 */
class Responder extends Di\Config
{

    public function define(Di\Container $di)
    {

        /**
         * Basic configuration for base responder.
         */

        // A map of helpers,
        $map = [
            'linkgenerator' => $di->lazyNew('Modus\Template\Helper\LinkGenerator'),
        ];

        $config = $di->get('config')->getConfig();
        $registry = require($config['root_path'] . '/config/view_registry.php');

        $di->params['Aura\View\View'] = [
            'view_registry' => $di->lazyNew('Aura\View\TemplateRegistry', ['map' => $registry['views']]),
            'layout_registry' => $di->lazyNew('Aura\View\TemplateRegistry', ['map' => $registry['layout']]),
            'helpers' => $di->lazyNew('Aura\Html\HelperLocator'),
        ];

        /**
         * Aura\Accept\Accept
         */
        $di->params['Aura\Accept\Accept'] = array(
            'charset' => $di->lazyNew('Aura\Accept\Charset\CharsetNegotiator'),
            'encoding' => $di->lazyNew('Aura\Accept\Encoding\EncodingNegotiator'),
            'language' => $di->lazyNew('Aura\Accept\Language\LanguageNegotiator'),
            'media' => $di->lazyNew('Aura\Accept\Media\MediaNegotiator'),
        );
        /**
         * Aura\Accept\AbstractNegotiator
         */
        $di->params['Aura\Accept\AbstractNegotiator'] = array(
            'value_factory' => $di->lazyNew('Aura\Accept\ValueFactory'),
            'server' => $_SERVER,
        );

        $di->params['Modus\Response\ResponseManager'] = [
            'httpResponse' => $di->lazyNew('Modus\Response\HttpResponse'),
            'contentNegotiation' => $di->lazyNew('Aura\Accept\Accept'),
        ];

        $di->params['Modus\Response\Response'] = [
            'response' => $di->lazyNew('Aura\Web\Response'),
        ];

        /**
         * Configuration of each individual responder.
         */

        $di->params['Example\Responder\Index'] = [
            'response' => $di->lazyNew('Modus\Response\Response'),
            'template' => $di->lazyNew('Aura\View\View'),
        ];


    }
}
