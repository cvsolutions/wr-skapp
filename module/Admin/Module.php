<?php
namespace Admin;

use Zend\Stdlib\ArrayUtils;

class Module
{
    public function getConfig()
    {
        $config = include __DIR__ . '/config/module.config.php';
        $config = ArrayUtils::merge($config, include __DIR__ . '/config/route.config.php');
        $config = ArrayUtils::merge($config, include __DIR__ . '/config/controller.config.php');
        $config = ArrayUtils::merge($config, include __DIR__ . '/config/bjyauthorize.config.php');
        return $config;
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
