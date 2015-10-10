<?php

use Aura\Di\ContainerBuilder;

require_once('../vendor/autoload.php');
$configDir = realpath('../config');
$builder = new Aura\Di\ContainerBuilder();

$dotEnv = new \Dotenv\Dotenv($configDir);
$dotEnv->load();

$config = new Modus\Config\Config($_ENV['MODUS_ENV'], $configDir);

$services = ['config' => $config];
$containerBuilder = new ContainerBuilder();
$configArray = $config->getConfig();
$container = $containerBuilder->newInstance($services, $configArray['config_classes'], ContainerBuilder::DISABLE_AUTO_RESOLVE);

$framework = $container->newInstance('Modus\Application\Bootstrap');
$framework->execute();
