<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace GodataRest\Controller;

/**
 * Description of AbstractGodataController
 *
 * @author allapow
 */
class AbstractGodataController extends \Zend\Mvc\Controller\AbstractRestfulController
{

    /**
     *
     * @var \Zend\Log\Logger
     */
    protected $logger;

    /**
     * https://developer.mozilla.org/en-US/docs/Web/HTTP/Access_control_CORS
     * wird vom browser nur einmal aufgerufen
     * ...damit werden die header einmalig gesetzt:
     * 2016-02-02T14:11:38+01:00 DEBUG (7): onDispatch Method: options
     * 2016-02-02T14:11:38+01:00 DEBUG (7): options :)
     * 2016-02-02T14:11:38+01:00 DEBUG (7): REQUEST_METHOD == OPTIONS
     * 2016-02-02T14:11:38+01:00 DEBUG (7): HTTP_ACCESS_CONTROL_REQUEST_METHOD
     * 2016-02-02T14:11:38+01:00 DEBUG (7): HTTP_ACCESS_CONTROL_REQUEST_HEADERS
     * 2016-02-02T14:11:38+01:00 DEBUG (7): onDispatch Method: post
     * 2016-02-02T14:11:38+01:00 DEBUG (7): create: Array
     * (
     *     [id] => 0
     *     [articleNo] => 34634
     *     [articleType] => 3456
     *     [articleGroup] => 345656
     *     [articleClass] => 1
     *     [descShort] => fghjgh
     * )
     * 
     * 2016-02-02T14:11:54+01:00 DEBUG (7): onDispatch Method: post
     * 2016-02-02T14:11:54+01:00 DEBUG (7): create: Array
     * (
     *     [id] => 0
     *     [articleNo] => 34634
     *     [articleType] => 3456
     *     [articleGroup] => 345656
     *     [articleClass] => 1
     *     [descShort] => fghjgh
     * )
     */
    public function options()
    {
        $this->getLogger()->debug('options :)');
//        header('Access-Control-Allow-Methods: GET,PUT,POST,DELETE');
//        parent::options();
//        $this->response->setStatusCode(200);
//        return array();
        /*
         * http://stackoverflow.com/questions/30868561/cors-post-request-in-zf2-becomes-options-request-instead/30868835#30868835
         * or short:
         * http://stackoverflow.com/a/30868835/1307876
         * 
         *  Allow from any origin
         */
        if (isset($_SERVER['HTTP_ORIGIN'])) {
//            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header("Access-Control-Allow-Origin: *"); // da kann das aus der Module.php wohl raus
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');    // cache for 1 day
        }

        // Access-Control headers are received during OPTIONS requests
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            $this->getLogger()->debug('REQUEST_METHOD == OPTIONS');
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
                header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
                $this->getLogger()->debug('HTTP_ACCESS_CONTROL_REQUEST_METHOD');
            }

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
                header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
                $this->getLogger()->debug('HTTP_ACCESS_CONTROL_REQUEST_HEADERS');
            }

            exit(0);
        }
    }

    public function onDispatch(\Zend\Mvc\MvcEvent $e)
    {
//        $request = $this->getRequest();
//        $method = strtolower($request->getMethod());
//        $this->getLogger()->debug('onDispatch Method: ' . $method);
        return parent::onDispatch($e);
    }

    /**
     * 
     * @return \Zend\Log\Logger
     */
    protected function getLogger()
    {
        if (!isset($this->logger) || !($this->logger instanceof \Zend\Log\Logger)) {
            $this->logger = $this->serviceLocator->get('logger');
        }
        return $this->logger;
    }
}
