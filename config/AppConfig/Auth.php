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
        $di->set('aura/auth:adapter', $di->lazyNew($config['authentication_adapter']));

        $di->set('aura/auth:auth', $di->lazyNew('Aura\Auth\Auth'));
        $di->set('aura/auth:login_service', $di->lazyNew('Aura\Auth\Service\LoginService'));
        $di->set('aura/auth:logout_service', $di->lazyNew('Aura\Auth\Service\LogoutService'));
        $di->set('aura/auth:resume_service', $di->lazyNew('Aura\Auth\Service\ResumeService'));
        $di->set('aura/auth:session', $di->lazyNew('Aura\Auth\Session\Session'));

        $di->params['Modus\Auth\Service'] = [

            'loginService' => $di->lazyGet('aura/auth:login_service'),
            'logoutService' => $di->lazyGet('aura/auth:logout_service'),
            'resumeService' => $di->lazyGet('aura/auth:resume_service'),
            'userObj' => $di->lazyGet('aura/auth:auth'),
        ];

        /**
         * Aura\Auth\Auth
         */
        $di->params['Aura\Auth\Auth'] = array(
            'segment' => $di->lazyNew('Aura\Auth\Session\Segment')
        );

        /**
         * Aura\Auth\Service\LoginService
         */
        $di->params['Aura\Auth\Service\LoginService'] = array(
            'adapter' => $di->lazyGet('aura/auth:adapter'),
            'session' => $di->lazyGet('aura/auth:session')
        );

        /**
         * Aura\Auth\Service\LogoutService
         */
        $di->params['Aura\Auth\Service\LogoutService'] = array(
            'adapter' => $di->lazyGet('aura/auth:adapter'),
            'session' => $di->lazyGet('aura/auth:session')
        );

        /**
         * Aura\Auth\Service\ResumeService
         */
        $di->params['Aura\Auth\Service\ResumeService'] = array(
            'adapter' => $di->lazyGet('aura/auth:adapter'),
            'session' => $di->lazyGet('aura/auth:session'),
            'timer' => $di->lazyNew('Aura\Auth\Session\Timer'),
            'logout_service' => $di->lazyGet('aura/auth:logout_service'),
        );

        /**
         * Aura\Auth\Session\Timer
         */
        $di->params['Aura\Auth\Session\Timer'] = array(
            'ini_gc_maxliftime' => ini_get('session.gc_maxlifetime'),
            'ini_cookie_liftime' => ini_get('session.cookie_lifetime'),
            'idle_ttl' => 1440,
            'expire_ttl' => 14400,
        );

        /**
         * Aura\Auth\Session\Session
         */
        $di->params['Aura\Auth\Session\Session'] = array(
            'cookie' => $_COOKIE,
        );

        /**
         * Aura\Auth\Verifier\PasswordVerifier
         */
        $di->params['Aura\Auth\Verifier\PasswordVerifier'] = array(
            'algo' => 'NO_ALGO_SPECIFIED',
        );

        $di->params['Modus\Auth\Router\Standard'] = [
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
