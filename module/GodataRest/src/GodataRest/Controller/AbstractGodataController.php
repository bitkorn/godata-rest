<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace GodataRest\Controller;

/**
 * All controller extends AbstractGodataController
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
     *
     * @var \Zend\Session\Container
     */
    protected $userContainer;
    
    /**
     *
     * @var \GodataRest\Entity\Common\UserEntity
     */
    protected $user;
    
    /**
     * It is recommended to use the response array. Predefined with the keys 'messages', 'data' and 'result'.
     * messages: array with messages. Messages with an integer key are global and with string key they belongs to a datafield.
     * data: an array with the data
     * result: a status/result integer (default 0).
     * @var array
     */
    protected $responseArr = ['messages' => [], 'data' => [], 'result' => 0];

    /**
     * https://developer.mozilla.org/en-US/docs/Web/HTTP/Access_control_CORS
     * "only requested once" by the browser so the headers are set.
     * The headers:
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
//        $this->getLogger()->debug('options :)');
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
            /**
             * aus der Module.php kann es nicht raus
             * ...also hier
             */
//            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
//            header("Access-Control-Allow-Origin: http://godatapub.local"); // {$_SERVER['HTTP_REFERER']}
//            header('Access-Control-Allow-Credentials: true');
//            header('Access-Control-Max-Age: 86400');    // cache for 1 day
        }

        // Access-Control headers are received during OPTIONS requests
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
//            $this->getLogger()->debug('REQUEST_METHOD == OPTIONS');
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
                header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
//                $this->getLogger()->debug('HTTP_ACCESS_CONTROL_REQUEST_METHOD');
            }

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
                header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
//                $this->getLogger()->debug('HTTP_ACCESS_CONTROL_REQUEST_HEADERS');
            }

            exit(0);
        }
    }

    public function onDispatch(\Zend\Mvc\MvcEvent $e)
    {
//        $request = $this->getRequest();
//        $method = strtolower($request->getMethod());
//        $this->getLogger()->debug('onDispatch Method: ' . $method);
//        $this->getLogger()->debug('onDispatch class: ' . get_class($this));
        return parent::onDispatch($e);
    }
    
    public function dispatch(\Zend\Stdlib\RequestInterface $request, \Zend\Stdlib\ResponseInterface $response = null)
    {
//        $this->userContainer = new \Zend\Session\Container('user');
//        $this->user = $this->userContainer->entity;
//        $this->getLogger()->debug('dispatch class: ' . get_class($this));
        return parent::dispatch($request, $response);
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
