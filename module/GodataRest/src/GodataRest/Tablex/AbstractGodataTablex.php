<?php

namespace GodataRest\Tablex;

use Zend\Db\Adapter\AdapterAwareInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Log\Logger;

/**
 * Description of AbstractGodataTablex
 *
 * @author allapow
 */
class AbstractGodataTablex implements AdapterAwareInterface
{

    /**
     *
     * @var \Zend\Db\Adapter\Adapter
     */
    protected $adapter;

    /**
     *
     * @var \Zend\Log\Logger
     */
    protected $logger;

    public function setDbAdapter(Adapter $adapter)
    {
        $this->adapter = $adapter;
    }

    public function setLogger(Logger $logger)
    {
        $this->logger = $logger;
    }

}
