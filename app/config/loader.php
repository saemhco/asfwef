<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs([
    APP_PATH . $config->application->controllersDir,
    APP_PATH . $config->application->pluginsDir,
    APP_PATH . $config->application->libraryDir,
    APP_PATH . $config->application->modelsDir,
    APP_PATH . $config->application->formsDir,
    APP_PATH . $config->application->mailerDir,
    APP_PATH . $config->application->googleAuth2,
    APP_PATH . $config->application->phpqrcode
])->register();

$loader->registerNamespaces([
    'App\Core\Constants' => APP_PATH . $config->application->constantsDir,
]);

$loader->registerClasses([
    'Services' => APP_PATH . 'app/Services.php'
]);
