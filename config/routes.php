<?php

/**
 *
 * Example:
 *
 * 'some_route' => [
 *          'path' => '/a/b/{c}{format}',
 *          'values' => [
 *              'action' => 'Application\Controller\Index',
 *              'responder' => 'Application\Responder\Index',
 *              'method' => 'index',
 *              'format' => 'html' // a default param value for format
 *      ],
 *      'params' => ['c' => '\d+', 'format' => '(\.[^/]+)?',],
 *      'secure' => false,
 *      'request' => 'GET|POST'
 * ],
 **/
return array(

    'metadata' => [

    ],

    'routes' => [
        'some_route' => [
            'path' => '/',
            'values' => [
                'action' => 'Example\Action\Index',
                'responder' => 'Example\Responder\Index',
                'method' => 'index',
            ],
            'request' => 'GET'
        ],
    ],


    'route_groups' => [
    ],
);
