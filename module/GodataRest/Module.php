<?php

namespace GodataRest;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\ControllerProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\Mvc\MvcEvent;

/**
 * 
 * 
 */
class Module implements AutoloaderProviderInterface, BootstrapListenerInterface, ControllerProviderInterface, ServiceProviderInterface
{

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    // if we're in a namespace deeper than one level we need to fix the \ in the path
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/', __NAMESPACE__),
                ),
            ),
        );
    }

    public function onBootstrap(\Zend\EventManager\EventInterface $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $sharedEventManager = $eventManager->getSharedManager();
        $serviceManager = $e->getApplication()->getServiceManager();
        $sharedEventManager->attach(
                __NAMESPACE__, MvcEvent::EVENT_DISPATCH, function($e) use ($serviceManager) {
            $strategy = $serviceManager->get('ViewJsonStrategy');
            $view = $serviceManager->get('ViewManager')->getView();
            $strategy->attach($view->getEventManager());
        }
        );

//        header('Access-Control-Allow-Origin: http://localhost:8383'); // AngularJS App
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');
//        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}"); // not set
//        header("Access-Control-Allow-Headers: X-PINGOTHER");
    }

    public function getControllerConfig()
    {
        return array(
            'factories' => array(
                'GodataRest\Controller\Article\Article' => function(\Zend\Mvc\Controller\ControllerManager $cm) {
                    $sl = $cm->getServiceLocator();
                    $ctr = new \GodataRest\Controller\Article\ArticleController();
                    $ctr->setArticleTable($sl->get('GodataRest\Table\Article\Article'));
                    $ctr->setArticleListTable($sl->get('GodataRest\Table\Article\ArticleList'));
                    return $ctr;
                },
                'GodataRest\Controller\Article\ArticleType' => function(\Zend\Mvc\Controller\ControllerManager $cm) {
                    $sl = $cm->getServiceLocator();
                    $ctr = new \GodataRest\Controller\Article\ArticleTypeController();
                    $ctr->setArticleTypeTable($sl->get('GodataRest\Table\Article\ArticleType'));
                    return $ctr;
                },
                'GodataRest\Controller\Article\ArticleList' => function(\Zend\Mvc\Controller\ControllerManager $cm) {
                    $sl = $cm->getServiceLocator();
                    $ctr = new \GodataRest\Controller\Article\ArticleListController();
                    $ctr->setArticleListTablex($sl->get('GodataRest\Tablex\Article\ArticleList'));
                    $ctr->setArticleListTable($sl->get('GodataRest\Table\Article\ArticleList'));
                    return $ctr;
                },
                'GodataRest\Controller\Stock\StockIn' => function(\Zend\Mvc\Controller\ControllerManager $cm) {
                    $sl = $cm->getServiceLocator();
                    $ctr = new \GodataRest\Controller\Stock\StockInController();
                    $ctr->setStockInTable($sl->get('GodataRest\Table\Stock\StockIn'));
                    $ctr->setStockInTablex($sl->get('GodataRest\Tablex\Stock\StockIn'));
                    return $ctr;
                },
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                /*
                 * Table
                 */
                'GodataRest\Table\Article\Article' => function(\Zend\ServiceManager\ServiceManager $sm) {
                    $table = new \GodataRest\Table\Article\ArticleTable();
                    $table->setDbAdapter($sm->get('dbGodatas'));
                    $table->setLogger($sm->get('logger'));
                    return $table;
                },
                'GodataRest\Table\Article\ArticleType' => function(\Zend\ServiceManager\ServiceManager $sm) {
                    $table = new \GodataRest\Table\Article\ArticleTypeTable();
                    $table->setDbAdapter($sm->get('dbGodatas'));
                    $table->setLogger($sm->get('logger'));
                    return $table;
                },
                'GodataRest\Table\Article\ArticleList' => function(\Zend\ServiceManager\ServiceManager $sm) {
                    $table = new \GodataRest\Table\Article\ArticleListTable();
                    $table->setDbAdapter($sm->get('dbGodatas'));
                    $table->setLogger($sm->get('logger'));
                    return $table;
                },
                'GodataRest\Table\Stock\StockIn' => function(\Zend\ServiceManager\ServiceManager $sm) {
                    $table = new \GodataRest\Table\Stock\StockInTable();
                    $table->setDbAdapter($sm->get('dbGodatas'));
                    $table->setLogger($sm->get('logger'));
                    return $table;
                },
                /*
                 * TableX
                 */
                'GodataRest\Tablex\Stock\StockIn' => function(\Zend\ServiceManager\ServiceManager $sm) {
                    $table = new \GodataRest\Tablex\Stock\StockInTablex();
                    $table->setDbAdapter($sm->get('dbGodatas'));
                    $table->setLogger($sm->get('logger'));
                    return $table;
                },
                'GodataRest\Tablex\Article\ArticleList' => function(\Zend\ServiceManager\ServiceManager $sm) {
                    $table = new \GodataRest\Tablex\Article\ArticleListTablex();
                    $table->setDbAdapter($sm->get('dbGodatas'));
                    $table->setLogger($sm->get('logger'));
                    return $table;
                },
            )
        );
    }

}
