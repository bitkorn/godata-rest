<?php

namespace GodataRest;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\ControllerProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\ValidatorProviderInterface;
use Zend\Mvc\MvcEvent;

/**
 * 
 * 
 */
class Module implements AutoloaderProviderInterface, BootstrapListenerInterface, ControllerProviderInterface, ServiceProviderInterface,
        ValidatorProviderInterface
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
                __NAMESPACE__, MvcEvent::EVENT_DISPATCH,
                function($e) use ($serviceManager) {
            $strategy = $serviceManager->get('ViewJsonStrategy');
            $view = $serviceManager->get('ViewManager')->getView();
            $strategy->attach($view->getEventManager());
        }
        );
        /**
         * Access-Control-Allow-Origin must be dynamic
         * because requests with credentials need the right URL:
         * https://developer.mozilla.org/de/docs/Web/HTTP/Access_control_CORS#Requests_with_credentials
         */
        if(!isset($_SERVER['HTTP_REFERER'])) {
//            throw new \RuntimeException('call without HTTP_REFERER not possible');
        }
//        $referer = $_SERVER['HTTP_REFERER'];
//        $slashPos = strpos($referer, '/', 7);
        
//        $origin = substr($referer, 0, strpos($_SERVER['HTTP_REFERER'], '/', 7));
//        header("Access-Control-Allow-Origin: $origin");
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
//        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');
        $config = $serviceManager->get('config');
        header("Access-Control-Allow-Headers: " . implode(',', $config['access_control_allow_headers']));
//        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}"); // not set
//        header("Access-Control-Allow-Headers: X-PINGOTHER");
        
//        $logger = $serviceManager->get('logger');
//        $logger->debug('all Headers: ' . print_r(apache_request_headers(), true)); // funzt aufm Server (STRATO) nicht
    }

    public function getControllerConfig()
    {
        return array(
            'factories' => array(
                'GodataRest\Controller\Common\Authorization' => function(\Zend\Mvc\Controller\ControllerManager $cm) {
                    $ctr = new \GodataRest\Controller\Common\AuthorizationController();
                    return $ctr;
                },
                'GodataRest\Controller\Article\Article' => function(\Zend\Mvc\Controller\ControllerManager $cm) {
                    $sl = $cm->getServiceLocator();
                    $ctr = new \GodataRest\Controller\Article\ArticleController();
                    $ctr->setArticleTable($sl->get('GodataRest\Table\Article\Article'));
                    $ctr->setArticleListTable($sl->get('GodataRest\Table\Article\ArticleList'));
                    $ctr->setArticleNewFilter($sl->get('GodataRest\Input\Article\ArticleNew'));
                    return $ctr;
                },
                'GodataRest\Controller\Article\ArticleType' => function(\Zend\Mvc\Controller\ControllerManager $cm) {
                    $sl = $cm->getServiceLocator();
                    $ctr = new \GodataRest\Controller\Article\ArticleTypeController();
                    $ctr->setArticleTypeTable($sl->get('GodataRest\Table\Article\ArticleType'));
                    return $ctr;
                },
                'GodataRest\Controller\Article\ArticleGroup' => function(\Zend\Mvc\Controller\ControllerManager $cm) {
                    $sl = $cm->getServiceLocator();
                    $ctr = new \GodataRest\Controller\Article\ArticleGroupController();
                    $ctr->setArticleGroupTable($sl->get('GodataRest\Table\Article\ArticleGroup'));
                    return $ctr;
                },
                'GodataRest\Controller\Article\ArticleClass' => function(\Zend\Mvc\Controller\ControllerManager $cm) {
                    $sl = $cm->getServiceLocator();
                    $ctr = new \GodataRest\Controller\Article\ArticleClassController();
                    $ctr->setArticleClassTable($sl->get('GodataRest\Table\Article\ArticleClass'));
                    return $ctr;
                },
                'GodataRest\Controller\Common\Unit' => function(\Zend\Mvc\Controller\ControllerManager $cm) {
                    $sl = $cm->getServiceLocator();
                    $ctr = new \GodataRest\Controller\Common\UnitController();
                    $ctr->setUnitTable($sl->get('GodataRest\Table\Common\Unit'));
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
                    $ctr->setStockInFilter($sl->get('GodataRest\Input\Stock\StockIn'));
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
                'GodataRest\Table\Article\ArticleGroup' => function(\Zend\ServiceManager\ServiceManager $sm) {
                    $table = new \GodataRest\Table\Article\ArticleGroupTable();
                    $table->setDbAdapter($sm->get('dbGodatas'));
                    $table->setLogger($sm->get('logger'));
                    return $table;
                },
                'GodataRest\Table\Article\ArticleClass' => function(\Zend\ServiceManager\ServiceManager $sm) {
                    $table = new \GodataRest\Table\Article\ArticleClassTable();
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
                'GodataRest\Table\Store\Store' => function(\Zend\ServiceManager\ServiceManager $sm) {
                    $table = new \GodataRest\Table\Store\StoreTable();
                    $table->setDbAdapter($sm->get('dbGodatas'));
                    $table->setLogger($sm->get('logger'));
                    return $table;
                },
                'GodataRest\Table\Common\Unit' => function(\Zend\ServiceManager\ServiceManager $sm) {
                    $table = new \GodataRest\Table\Common\UnitTable();
                    $table->setDbAdapter($sm->get('dbGodatas'));
                    $table->setLogger($sm->get('logger'));
                    return $table;
                },
                'GodataRest\Table\Common\User\User' => function(\Zend\ServiceManager\ServiceManager $sm) {
                    $table = new \GodataRest\Table\Common\User\UserTable();
                    $table->setDbAdapter($sm->get('dbGodatas'));
                    $table->setLogger($sm->get('logger'));
                    return $table;
                },
                'GodataRest\Table\Common\User\UserGroup' => function(\Zend\ServiceManager\ServiceManager $sm) {
                    $table = new \GodataRest\Table\Common\User\UserGroupTable();
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
                'GodataRest\Tablex\Common\Crud' => function(\Zend\ServiceManager\ServiceManager $sm) {
                    $table = new \GodataRest\Tablex\Common\CrudTablex();
                    $table->setDbAdapter($sm->get('dbGodatas'));
                    $table->setLogger($sm->get('logger'));
                    return $table;
                },
                /*
                 * Input
                 */
                'GodataRest\Input\Stock\StockIn' => function(\Zend\ServiceManager\ServiceManager $sm) {
                    $filter = new Input\Stock\StockInFilter();
                    /*
                     * because, registering Validators in getValidatorConfig() does not work:
                     */
                    $existArticleIdValidator = new Validator\Article\ExistArticleId();
                    $existArticleIdValidator->setArticleTable($sm->get('GodataRest\Table\Article\Article'));
                    $filter->setExistArticleIdValidator($existArticleIdValidator);
                    $existStoreIdValidator = new Validator\Store\ExistStoreId();
                    $existStoreIdValidator->setStoreTable($sm->get('GodataRest\Table\Store\Store'));
                    $filter->setExistStoreIdValidator($existStoreIdValidator);
                    $existUnitIdValidator = new Validator\Common\ExistUnitId();
                    $existUnitIdValidator->setUnitTable($sm->get('GodataRest\Table\Common\Unit'));
                    $filter->setExistUnitIdValidator($existUnitIdValidator);
                    return $filter;
                },
                'GodataRest\Input\Article\ArticleNew' => function(\Zend\ServiceManager\ServiceManager $sm) {
                    $filter = new Input\Article\ArticleNewFilter();
                    /*
                     * because, registering Validators in getValidatorConfig() does not work:
                     */
                    $existArticleTypeValidator = new Validator\Article\ExistArticleType();
                    $existArticleTypeValidator->setArticleTypeTable($sm->get('GodataRest\Table\Article\ArticleType'));
                    $filter->setExistArticleTypeValidator($existArticleTypeValidator);
                    $existArticleGroupValidator = new Validator\Article\ExistArticleGroup();
                    $existArticleGroupValidator->setArticleGroupTable($sm->get('GodataRest\Table\Article\ArticleGroup'));
                    $filter->setExistArticleGroupValidator($existArticleGroupValidator);
                    return $filter;
                },
            )
        );
    }

    public function getValidatorConfig()
    {
        return array(
            'factories' => array(
                // does not work:
//                'GodataRest\Validator\Article\ExistArticleId' => function(\Zend\Validator\ValidatorPluginManager $pm) {
//                    $sm = $pm->getServiceLocator();
//                    $logger = $sm->get('logger');
//                    $logger->debug('getValidatorConfig: ' . get_class($pm));
//                    $validator = new \GodataRest\Validator\Article\ExistArticleId();
//                    $validator->setArticleTable($s->get('GodataRest\Table\Article\Article'));
//                    return $validator;
//                }
            )
        );
    }

}
