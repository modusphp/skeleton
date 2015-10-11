<?php

namespace AppConfig;

use Aura\Di;

/**
 * Set up the setters and other parameters passed into actions.
 *
 * Class Action
 * @package AppConfig\ADR
 */
class Auth extends Di\Config
{

    public function define(Di\Container $di)
    {
        $config = $di->get('config')->getConfig();

        /**
         * Services
         */

        // This is the adapter we need
        $di->set('modus/auth:adapter', $di->lazyNew($config['authentication_adapter']));

        $di->set('modus/auth:auth', $di->lazyNew('Modus\Auth\Auth'));
        $di->set('modus/auth:login_service', $di->lazyNew('Modus\Auth\Service\LoginService'));
        $di->set('modus/auth:logout_service', $di->lazyNew('Modus\Auth\Service\LogoutService'));
        $di->set('modus/auth:resume_service', $di->lazyNew('Modus\Auth\Service\ResumeService'));
        $di->set('modus/auth:session', $di->lazyNew('Modus\Auth\Session\Session'));

        $di->params['Modus\Auth\Service'] = [

            'loginService' => $di->lazyGet('modus/auth:login_service'),
            'logoutService' => $di->lazyGet('modus/auth:logout_service'),
            'resumeService' => $di->lazyGet('modus/auth:resume_service'),
            'userObj' => $di->lazyGet('modus/auth:auth'),
        ];

        /**
         * Modus\Auth\Auth
         */
        $di->params['Modus\Auth\Auth'] = array(
            'segment' => $di->lazyNew('Modus\Auth\Session\Segment')
        );

        /**
         * Modus\Auth\Service\LoginService
         */
        $di->params['Modus\Auth\Service\LoginService'] = array(
            'adapter' => $di->lazyGet('modus/auth:adapter'),
            'session' => $di->lazyGet('modus/auth:session')
        );

        /**
         * Modus\Auth\Service\LogoutService
         */
        $di->params['Modus\Auth\Service\LogoutService'] = array(
            'adapter' => $di->lazyGet('modus/auth:adapter'),
            'session' => $di->lazyGet('modus/auth:session')
        );

        /**
         * Modus\Auth\Service\ResumeService
         */
        $di->params['Modus\Auth\Service\ResumeService'] = array(
            'adapter' => $di->lazyGet('modus/auth:adapter'),
            'session' => $di->lazyGet('modus/auth:session'),
            'timer' => $di->lazyNew('Modus\Auth\Session\Timer'),
            'logout_service' => $di->lazyGet('modus/auth:logout_service'),
        );

        /**
         * Modus\Auth\Session\Timer
         */
        $di->params['Modus\Auth\Session\Timer'] = array(
            'ini_gc_maxliftime' => ini_get('session.gc_maxlifetime'),
            'ini_cookie_liftime' => ini_get('session.cookie_lifetime'),
            'idle_ttl' => 1440,
            'expire_ttl' => 14400,
        );

        /**
         * Modus\Auth\Session\Session
         */
        $di->params['Modus\Auth\Session\Session'] = array(
            'cookie' => $_COOKIE,
        );

        /**
         * Modus\Auth\Verifier\PasswordVerifier
         */
        $di->params['Modus\Auth\Verifier\PasswordVerifier'] = array(
            'algo' => 'NO_ALGO_SPECIFIED',
        );

        $di->params['Modus\Auth\Router\StandardAuth'] = [
            'authService' => $di->lazyNew('Modus\Auth\Service')
        ];

        /**
         * Configure adapter from config
         */

        $params = [];
        foreach ($config['authentication_settings'] as $key => $argument) {
            if(class_exists($argument)) {
                $params[$key] = $di->lazyNew($argument);
            } else {
                $params[$key] = $argument;
            }
        }

        $di->params[$config['authentication_adapter']] = $params;
    }
}
