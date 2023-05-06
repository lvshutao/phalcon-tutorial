<?php

namespace apps\frontend;

use Phalcon\Di\DiInterface;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\View;

class Module implements ModuleDefinitionInterface
{

    public function registerAutoloaders(DiInterface $container = null)
    {

    }

    public function registerServices(DiInterface $container)
    {

        $dispatcher = $container->get('dispatcher');
        $dispatcher->setDefaultNamespace('apps\frontend\controllers');

        $container->set('view', function () {
            $view = new View();
            $view->setViewsDir(PATH_APPS . 'frontend/views');
            return $view;
        });
    }
}