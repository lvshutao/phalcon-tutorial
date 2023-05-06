<?php
$loader = new \Phalcon\Autoload\Loader();
$loader->setNamespaces([
    'apps' => __DIR__,
])->register();
try {
    $di = new Phalcon\Di\FactoryDefault();

    $di->set('router', function () {
        $router = new Phalcon\Mvc\Router(false);
        $router->removeExtraSlashes(true);

        $router->setDefaultModule('frontend');
        $router->add('', ['module' => 'frontend']);
        $router->add('/', ['module' => 'frontend']);

        $router->add('/admin', ['module' => 'admin']);
        $router->add('/frontend', ['module' => 'frontend']);

        $router->add(
            '/:module/:controller/:action/:params',
            ['module' => 1, 'controller' => 2, 'action' => 3, 'params' => 4]
        );
        $router->add(
            '/:module/:controller/:action',
            ['module' => 1, 'controller' => 2, 'action' => 3]
        );
        $router->add(
            '/:module/:controller',
            ['module' => 1, 'controller' => 2]
        );

        $router->notFound([
            'action' => 'notfound'
        ]);

        return $router;
    });

    $di->set('url', function () {
        $url = new Phalcon\Mvc\Url();
        $url->setBaseUri('/');
        return $url;
    });

    $application = new \Phalcon\Mvc\Application();
    $application->setDI($di);

// 模型注册
    foreach (['frontend', 'admin'] as $name) {
        $application->registerModules([
            $name => [
                'className' => 'apps\\' . $name . '\Module',
                'path' => PATH_APPS . '/' . $name . '/Module.php'
            ]
        ], true);
    }
    $response = $application->handle($_SERVER['REQUEST_URI']);
    echo $response->getContent();
} catch (PDOException $e) {
    echo 'SQL ERROR: ';
    echo $e->getMessage();
} catch (\Exception $e) {
    echo '<pre>';
    echo 'FILE:', $e->getFile(), PHP_EOL;
    echo 'LINE:', $e->getLine(), PHP_EOL;
    echo $e->getMessage();
}