<?php

$rootPath = realpath(__DIR__ . '/..');

return array(

    /*
     * --------------------------------------------------
     * What environment are we in?
     * --------------------------------------------------
     */
    "environment" => $_ENV['MODUS_ENV'],

    /*
     * --------------------------------------------------
     * Default Root Path
     * --------------------------------------------------
     */

    "root_path" => $rootPath,

    /*
     * --------------------------------------------------
     * Database Configuration
     * --------------------------------------------------
     */
    'database' => [
        'type' => 'mysql',
        'dbname' => '',
        'default' => [
            "user" => "",
            "pass" => "",
            "host" => "127.0.0.1",
        ],
        'write' => [
            'master' => [
                "user" => "",
                "pass" => "",
                "host" => "127.0.0.1",
            ],
        ],
        'read' => [
            'slave' => [
                "user" => "",
                "pass" => "",
                "host" => "127.0.0.1",
            ],
        ]
    ],

    /*
     * --------------------------------------------------
     * Error statuses and the responders to use.
     * --------------------------------------------------
     */
    'error_page' => [
        // These are fully qualified namespaces
        '404' => 'Some\Namespace\Responder\Page404',
        '406' => 'Some\Namespace\Responder\Page406',
    ],

    /*
     * --------------------------------------------------
     * Template Directory and Layout
     * --------------------------------------------------
     */
    "template" => [
        "layout" => "$rootPath/views/",
        "views" => "$rootPath/views/",
    ],

    /*
     * --------------------------------------------------
     * Default Session Configuration
     * --------------------------------------------------
     */
    'default_session_segment' => 'modus',

    /*
     * --------------------------------------------------
     * Default Error Configuration
     * --------------------------------------------------
     */
    'error_logging' => [
        'logger' => 'Monolog\Logger',
        'logs' => [
            'error' => [
                'handlers' => [
                    'Monolog\Handler\StreamHandler' => [
                        $rootPath . '/logs/error.log'
                    ]
                ],
                'formatter' => 'Monolog\Formatter\LineFormatter',
                'formatterArgs' => [
                    'format' => "%datetime% > %level_name% > %message% %context% %extra%\n",
                    'dateFormat' => 'c'
                ]
            ],
            'event' => [
                'handlers' => [
                    'Monolog\Handler\StreamHandler' => [
                        $rootPath . '/logs/error.log'
                    ],
                ],
                'formatter' => 'Monolog\Formatter\LineFormatter',
                'formatterArgs' => [
                    'format' => "%datetime% > %level_name% > %message% %context% %extra%\n",
                    'dateFormat' => 'c'
                ]
            ]
        ]
    ],

    /*
     * --------------------------------------------------
     * BooBoo Configuration
     * --------------------------------------------------
     */
    'use_booboo' => true,
    'silence_errors' => false,
    'default_formatter' => 'League\BooBoo\Formatter\HtmlTableFormatter',
    'error_page_formatter' => 'League\BooBoo\Formatter\HtmlTableFormatter',
    'formatter_accepts' => [
        'text/html' => 'League\BooBoo\Formatter\HtmlTableFormatter',
        'text/text' => 'League\BooBoo\Formatter\CommandLineFormatter',
        'application/json' => 'League\BooBoo\Formatter\JsonFormatter',
    ],

    /*
     * --------------------------------------------------
     * List of configuration classes to load (FQNS)
     * --------------------------------------------------
     */
    'config_classes' => [
        'AppConfig\Auth',
        'AppConfig\Bootstrap',
        'AppConfig\Router',
        'AppConfig\Database',
        'AppConfig\AuraWeb',
        'AppConfig\HtmlHelpers',
        'AppConfig\Session',
        'AppConfig\ErrorHandler',
        'AppConfig\ADR\Action',
        'AppConfig\ADR\Responder',
        'AppConfig\ADR\Domain',
    ],

    /*
     * --------------------------------------------------
     * Authentication Settings
     * --------------------------------------------------
     */
    'authentication_adapter' => 'Aura\Auth\Adapter\HtpasswdAdapter',
    'authentication_settings' => [
        'file' => '',
        'verifier' => 'Aura\Auth\Verifier\HtpasswdVerifier'
    ]
);
