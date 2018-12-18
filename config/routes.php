<?php

use Modus\Route\Manager as Route;

//    You can refer to the documentation found at
//    https://github.com/auraphp/Aura.Router/blob/3.x/docs/index.md for more on how to configure these
//    routes.
//
//    Routes returned are simple Aura.Router Route objects.
//
//    Example:
//
//    Route::route('example_route', '/a/b/{c}')
//        ->extras([
//            'action' => 'Application\Controller\Index',
//            'responder' => 'Application\Responder\Index',
//        ])
//        ->tokens(['c' => '\d+'])
//        ->secure(false)
//        ->allows(['GET', 'POST'])



return array(

    Route::route('some_route', '/')
        ->extras(['action' => 'Example\Action\Index', 'responder' => 'Example\Responder\Index'])
        ->secure(false)
        ->allows(['GET']),
);
