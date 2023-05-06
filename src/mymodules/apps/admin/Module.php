<?php

namespace apps\admin;

use Phalcon\Di\DiInterface;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\View;

class Module implements ModuleDefinitionInterface
{
    protected string $name = 'admin';

    public function registerAutoloaders(DiInterface $container = null)
    {
    }

    public function registerServices(DiInterface $container)
    {
        $name = $this->name;
        $container->set('dispatcher', function () use ($name) {
            $dispatcher = new Dispatcher();
            $dispatcher->setDefaultNamespace('apps\\' . $name . '\controllers');
            return $dispatcher;
        });

        $container->set('view', function () use ($name) {
            $view = new View();
            $view->setViewsDir(PATH_APPS . $name . '/views');
            return $view;
        });

    }
}