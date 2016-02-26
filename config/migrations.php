<?php

if (function_exists('xdebug_disable')) {
    xdebug_disable();
}

$rootPath = realpath(__DIR__ . '/..');

require($rootPath . '/vendor/autoload.php');

$dotenv = new \Dotenv\Dotenv($rootPath . '/config');
$dotenv->load();

$configuration = new Modus\Config\Config($_ENV['PHINX_ENV'], $rootPath . '/config', $dotenv);

$config = $configuration->getConfig();

return [

    "paths" => [
        "migrations" => "$rootPath/migrations"
    ],
    "environments" => [
        "default_migration_table" => "phinxlog",
        "default_database" => "default",
        "default" => [
            "adapter" => $config['database']['type'],
            "host" => $config['database']['default']['host'],
            "name" => $config['database']['dbname'],
            "user" => $config['database']['default']['user'],
            "pass" => $config['database']['default']['pass'],
            "port" => 3306
        ],
    ],
];
