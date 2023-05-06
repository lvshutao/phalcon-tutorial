<?php

use Phalcon\Autoload\Loader;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Mvc\View;

define('BASE_PATH', dirname(__DIR__));
const APP_PATH = BASE_PATH . '/app';

// Register an autoloader
// warning: don't use namespace in the controllers
$loader = new Loader();
$loader->setDirectories(
    [
        APP_PATH . '/controllers/',
        APP_PATH . '/models/',
    ]
)
    ->register();

// Create a DI
$container = new FactoryDefault();

// Setting up the view component
$container['view'] = function () {
    $view = new View();
    $view->setViewsDir(APP_PATH . '/views/');
    return $view;
};

// Setup a base URI so that all generated URIs include the "tutorial" folder
$container['url'] = function () {
    $url = new UrlProvider();
    $url->setBaseUri('/');
    return $url;
};

// Set the database service
$container['db'] = function () {
    return new DbAdapter([
        "host" => 'mysql',
        "username" => $_ENV['MYSQL_USER'],
        "password" => $_ENV['MYSQL_PASSWORD'],
        "dbname" => $_ENV['MYSQL_DATABASE'],
    ]);
};
unset($_ENV['MYSQL_ROOT_PASSWORD'], $_ENV['MYSQL_USER'], $_ENV['MYSQL_PASSWORD'], $_ENV['MYSQL_DATABASE']);

// Handle the request
try {
    $application = new Phalcon\Mvc\Application($container);
    $response = $application->handle($_SERVER["REQUEST_URI"]);
    $response->send();
} catch (Exception $e) {
    echo "Exception: ", $e->getMessage();
}
